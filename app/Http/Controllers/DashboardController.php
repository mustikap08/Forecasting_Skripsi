<?php

namespace App\Http\Controllers;

use App\Models\Aktual;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Aktual::all();

        $kategori = Kategori::all();

        return view('Dashboard.index', compact('data', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   

        $formattedPeriode = $request->input('periode-awal') . '/' . $request->input('periode-akhir');

        Aktual::create([
            'kategori_id' => $request->input('kategori'),
            'bulan' => $request->input('date'),
            'financial_year' => $formattedPeriode,
            'chain' => $request->input('chain'),
            'subrub' => $request->input('suburb'),
            // 'state' => $request->input('state'),
            // 'country' => $request->input('country'),
            'sales' => $request->input('sales'),
        ]);

        return redirect('/dashboard');
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
        $formattedPeriode = $request->input('periode-awal') . '/' . $request->input('periode-akhir');

        Aktual::findOrFail($id)->update([
            'kategori_id' => $request->input('kategori'),
            'bulan' => $request->input('date'),
            'financial_year' => $formattedPeriode,
            'chain' => $request->input('chain'),
            'subrub' => $request->input('suburb'),
            // 'state' => $request->input('state'),
            // 'country' => $request->input('country'),
            'sales' => $request->input('sales'),
        ]);

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Aktual::findOrFail($id)->delete();

        return back();
    }
}
