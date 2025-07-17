<?php

namespace App\Http\Controllers;

use App\Models\LoaRequest;
use App\Models\Journal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LoaController extends Controller
{
    // Tampilkan semua LOA yang disetujui
    public function index()
    {
        $loas = LoaRequest::with('journal.penerbit')
            ->where('status', 'approved')
            ->latest()
            ->paginate(10);

        return view('admin.loa.index', compact('loas'));
    }

    // Tampilkan detail LOA
    public function show($id)
    {
        $loa = LoaRequest::with('journal')->findOrFail($id);
        return view('admin.loa.show', compact('loa'));
    }

    // Form edit LOA
    public function edit($id)
    {
        // $loa = LoaRequest::findOrFail($id);
        // return view('admin.loa.edit', compact('loa'));

        $loa = LoaRequest::findOrFail($id);
        $journals = Journal::all(); // ambil semua jurnal untuk pilihan
        return view('admin.loa.edit', compact('loa', 'journals'));
    }

    // Update LOA
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'article_title'  => 'required|string|max:255',
            'article_author' => 'required|string|max:255',
            'volume'         => 'required|string|max:20',
            'number'         => 'required|string|max:20',
            'month'          => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'year'           => 'required|digits:4|integer|min:2000|max:' . now()->year,
            'journal_id'     => 'required|exists:journals,id',
            'link_journal'   => 'nullable|url|max:255',
            'kode_jurnal'    => 'nullable|string|max:50',
            'ttd'            => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $loa = LoaRequest::findOrFail($id);
        $loa->update($validated);

        return redirect()->route('admin.loas.index')->with('success', 'Data LOA berhasil diperbarui.');
    }

    public function frontend()
    {
        $loas = \App\Models\LoaRequest::with('journal')
            ->where('status', 'approved')
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('loa.frontend', compact('loas'));
    }

    public function destroy($id)
    {
        $loa = LoaRequest::findOrFail($id);
        $loa->delete();

        return redirect()->route('admin.loas.index')->with('success', 'Data LOA berhasil dihapus.');
    }

    public function print($registration_number, $lang)
    {
        $loa = LoaRequest::with('journal')->where('registration_number', $registration_number)->firstOrFail();

        // 🔁 Generate QR Code (SVG, tidak simpan ke file)
        // $qrCode = QrCode::format('svg')
        //     ->size(120)
        //     ->errorCorrection('H')
        //     ->generate(url('/loa/scan/' . $loa->registration_number));

        // Ambil file PNG dari qr_code_path di database
        $pngPath = storage_path('app/public/' . $loa->qr_code_path);

        if (file_exists($pngPath)) {
            $pngData = base64_encode(file_get_contents($pngPath));
            $qrImage = 'data:image/png;base64,' . $pngData;
        } else {
            $qrImage = null;
        }

        // Penamaan file & path
        $filename = $registration_number . '.pdf';
        $folder = $lang === 'en' ? 'en' : 'id';
        $path = public_path("storage/loa/{$folder}");

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Cetak PDF
        $pdf = Pdf::loadView("pdf.loa_{$lang}", [
            'loa'     => $loa,
            'qrImage' => $qrImage,
        ]);


        // 💾 Simpan PDF
        $pdf->save($path . '/' . $filename);

        // 🔁 Tampilkan preview PDF
        return $pdf->stream($filename);
    }

    // Cetak PDF dari publik (tanpa login)
    public function printPublic($id, Request $request)
    {
        $lang = $request->query('lang', 'id');
        $loa = LoaRequest::with('journal')->findOrFail($id);

        if ($loa->status !== 'approved') {
            abort(403, 'LOA belum disetujui.');
        }

        $qrCode = QrCode::format('svg')->size(120)->generate(url('/loa/scan/' . $loa->registration_number));
        $pdf = Pdf::loadView("pdf.loa_{$lang}", compact('loa', 'qrCode'));
        return $pdf->stream("LOA-{$loa->registration_number}.pdf");
    }
}
