<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\LoaRequest;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;


class LoaRequestController extends Controller
{
    /**
     * Menampilkan daftar permintaan LOA dengan status 'pending'.
     */
    public function index()
    {
        $requests = LoaRequest::with('journal')
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.loarequests.index', compact('requests'));
    }

    /**
     * Menampilkan form permintaan LOA (frontend, publik).
     */
    public function create()
    {
        $journals = Journal::all();
        return view('loa.form', compact('journals'));
    }

    /**
     * Menyimpan permintaan LOA ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_article'      => 'required|string|max:100',
            'volume'          => 'required|string|max:20',
            'number'          => 'required|string|max:20',
            'month'           => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'year'            => 'required|digits:4|integer|min:2000|max:' . now()->year,
            'article_title'   => 'required|string|max:255',
            'article_author'  => 'required|string|max:255',
            'journal_id'      => 'required|exists:journals,id',
        ]);

        // Buat nomor registrasi: LOA + timestamp + id_article
        $timestamp = now()->format('Ymd'); // contoh hasil: 20250628
        $idArticleClean = strtoupper(preg_replace('/\s+/', '', $validated['id_article']));
        $regNumber = 'LOA' . $timestamp . $idArticleClean;

        $validated['registration_number'] = $regNumber;
        $validated['status'] = 'pending';

        LoaRequest::create($validated);

        return redirect()->route('loa.sukses')->with('regNumber', $regNumber);
    }

    /**
     * Menyetujui permintaan LOA.
     */

    public function approve($id)
    {
        $req = LoaRequest::with('journal')->findOrFail($id);

        $kodeJurnal = $req->journal->kode_jurnal ?? 'JURNAL';
        $jumlahSebelumnya = LoaRequest::where('status', 'approved')->count() + 1;

        $bulan = str_pad(date('m', strtotime($req->created_at)), 2, '0', STR_PAD_LEFT);
        $tahun = date('Y', strtotime($req->created_at));

        $letterNumber = "{$jumlahSebelumnya}/{$kodeJurnal}/{$req->id_article}/{$bulan}/{$tahun}";
        $req->letter_number = $letterNumber;
        $req->status = 'approved';

        // QR Code
        $qrContent = url('/loa/scan/' . $req->registration_number);
        $qrPath = 'qrcodes/' . $req->registration_number . '.png';

        // Generate QR ke storage/app/public/qrcodes/
        $qrImage = QrCode::format('png')->size(300)->generate($qrContent);
        Storage::disk('public')->put($qrPath, $qrImage);

        $req->qr_code_path = $qrPath;
        $req->save();

        return redirect()->route('admin.loarequests.index')->with('success', 'Permintaan LOA disetujui.');
    }



    /**
     * Menolak permintaan LOA dan menghapus datanya.
     */
    public function reject($id)
    {
        $req = LoaRequest::findOrFail($id);
        $req->delete();

        return redirect()->route('admin.loarequests.index')->with('success', 'Permintaan LOA ditolak dan dihapus.');
    }
}
