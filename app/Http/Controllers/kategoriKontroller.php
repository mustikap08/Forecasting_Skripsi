<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class kategoriKontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Kategori::all();

        return view('Dashboard.kategori', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Kategori::create([
            'kategori' => $request->input('kategori'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return redirect('/kategori');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Kategori::findOrFail($id)->update([
            'kategori' => $request->input('kategori'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return redirect('/kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
