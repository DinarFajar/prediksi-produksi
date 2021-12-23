<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Http\Requests\ProductionRequest;
use App\Libraries\FuzzyMamdani;
use PDF;

class ProductionController extends Controller
{
    private $dir = 'productions.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['productions'] = Production::latest()->get();

        return view($this->dir.'index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->dir.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductionRequest $request)
    {
        $data = $request->validated();

        if($request->filled('balance')) {
            $data['prediction'] = (new FuzzyMamdani($data['demand'], $data['balance']))->prediksiFix;
        }

        if($request->filled('deficit')) {
            $data['prediction'] = (new FuzzyMamdani($data['demand'], 0, $data['deficit']))->prediksiFix;
        }

        Production::create($data);

        return redirect()
            ->route('productions.index')
            ->with('success', 'Data Produksi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function show(Production $production)
    {
        $data['production'] = $production;

        return view($this->dir.'show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function edit(Production $production)
    {
        $data['production'] = $production;

        return view($this->dir.'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductionRequest  $request
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function update(ProductionRequest $request, Production $production)
    {
        $data = $request->validated();

        if($request->filled('balance')) {
            $data['prediction'] = (new FuzzyMamdani($data['demand'], $data['balance']))->prediksiFix;
        }

        if($request->filled('deficit')) {
            $data['prediction'] = (new FuzzyMamdani($data['demand'], 0, $data['deficit']))->prediksiFix;
        }

        $production->update($data);

        return redirect()
            ->route('productions.show', ['production' => $production->id])
            ->with('success', 'Data Produksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function destroy(Production $production)
    {
        $production->delete();

        return redirect()
            ->route('productions.index')
            ->with('success', 'Data Produksi berhasil dihapus');
    }

    public function print()
    {
        $data['productions'] = Production::latest()->get();

        $pdf = PDF::loadView('productions.pdf', $data);
        
        return $pdf->download('rekap-data-produksi.pdf');
    }
}
