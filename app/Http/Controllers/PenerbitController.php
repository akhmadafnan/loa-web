<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $penerbits = Penerbit::latest()->get();
        $penerbits = Penerbit::latest()->paginate(10);
        return view('admin.penerbit.index', compact('penerbits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.penerbit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'logo' => 'nullable|image|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('penerbit_logos', 'public');
        }

        Penerbit::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.penerbits.index')->with('success', 'Penerbit berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penerbit $penerbit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penerbit $penerbit)
    {
        return view('admin.penerbit.edit', compact('penerbit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penerbit $penerbit)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($penerbit->logo) {
                Storage::disk('public')->delete($penerbit->logo);
            }
            $logoPath = $request->file('logo')->store('penerbit_logos', 'public');
            $penerbit->logo = $logoPath;
        }

        $penerbit->update($request->only(['nama', 'alamat', 'no_hp', 'email']));
        $penerbit->save();

        return redirect()->route('admin.penerbits.index')->with('success', 'Penerbit diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penerbit $penerbit)
    {
        if ($penerbit->logo) {
            Storage::disk('public')->delete($penerbit->logo);
        }

        $penerbit->delete();
        return redirect()->route('admin.penerbits.index')->with('success', 'Penerbit dihapus');
    }
}
