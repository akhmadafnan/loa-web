<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::latest()->paginate(10);
        return view('admin.journal.index', compact('journals'));
    }

    public function create()
    {
        return view('admin.journal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_journals' => 'required|string|max:255',
            'e_issn'        => 'required|string|max:100',
            'p_issn'        => 'required|string|max:100',
            'website_url'   => 'required|url',
            'editor_name'   => 'required|string|max:255',
            'logo'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'kode_jurnal'   => 'nullable|string|max:50',
            'ttd'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'name_journals',
            'e_issn',
            'p_issn',
            'website_url',
            'editor_name',
            'kode_jurnal',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('journals', 'public');
        }

        if ($request->hasFile('ttd')) {
            $data['ttd'] = $request->file('ttd')->store('ttd', 'public');
        }

        Journal::create($data);

        return redirect()->route('admin.journals.index')->with('success', 'Journal created successfully.');
    }

    public function edit(Journal $journal)
    {
        return view('admin.journal.edit', compact('journal'));
    }

    public function update(Request $request, Journal $journal)
    {
        $request->validate([
            'name_journals' => 'required|string|max:255',
            'e_issn'        => 'required|string|max:100',
            'p_issn'        => 'required|string|max:100',
            'website_url'   => 'required|url',
            'editor_name'   => 'required|string|max:255',
            'logo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kode_jurnal'   => 'nullable|string|max:50',
            'ttd'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'name_journals',
            'e_issn',
            'p_issn',
            'website_url',
            'editor_name',
            'kode_jurnal',
        ]);

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($journal->logo && Storage::disk('public')->exists($journal->logo)) {
                Storage::disk('public')->delete($journal->logo);
            }
            $data['logo'] = $request->file('logo')->store('journals', 'public');
        }

        if ($request->hasFile('ttd')) {
            // Hapus ttd lama jika ada
            if ($journal->ttd && Storage::disk('public')->exists($journal->ttd)) {
                Storage::disk('public')->delete($journal->ttd);
            }
            $data['ttd'] = $request->file('ttd')->store('ttd', 'public');
        }

        $journal->update($data);

        return redirect()->route('admin.journals.index')->with('success', 'Journal updated successfully.');
    }

    public function destroy(Journal $journal)
    {
        // Hapus logo
        if ($journal->logo && Storage::disk('public')->exists($journal->logo)) {
            Storage::disk('public')->delete($journal->logo);
        }

        // Hapus ttd
        if ($journal->ttd && Storage::disk('public')->exists($journal->ttd)) {
            Storage::disk('public')->delete($journal->ttd);
        }

        $journal->delete();

        return redirect()->route('admin.journals.index')->with('success', 'Journal berhasil dihapus.');
    }
}
