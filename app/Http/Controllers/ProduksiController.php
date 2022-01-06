<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Http\Requests\ProduksiRequest;
use PDF;

class ProduksiController extends Controller
{
    private $dir = 'produksi.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['produksi'] = Produksi::all();

        return view($this->dir.'index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProduksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Produksi $produksi)
    {
        $produksi->update([
            'produksi' => $produksi->prediksi->prediksi
        ]);

        return back()->with('success', 'Nilai Produksi berhasil ditambahkan');
    }

    public function storeManually(ProduksiRequest $request, Produksi $produksi)
    {
        $data = $request->validated();

        $produksi->update($data);

        return back()->with('success', 'Nilai Produksi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function show(Produksi $produksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Produksi $produksi)
    {
        $data['produksi'] = $produksi;

        return view($this->dir.'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProduksiRequest  $request
     * @param  \App\Models\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function update(ProduksiRequest $request, Produksi $produksi)
    {
        $data = $request->validated();

        $produksi->update($data);

        return redirect()
            ->route('produksi.index')
            ->with('success', 'Nilai Produksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produksi $produksi)
    {
        $produksi->update(['produksi' => 0]);

        return back()->with('success', 'Nilai Produksi berhasil dihapus');
    }

    public function print()
    {
        $data['produksi'] = Produksi::all();

        $pdf = PDF::loadView('produksi.pdf', $data);
        
        return $pdf->download('rekap-data-produksi.pdf');
    }
}
