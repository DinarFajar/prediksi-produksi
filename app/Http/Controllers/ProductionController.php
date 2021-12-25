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
        $data['productions'] = Production::all();

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

        if($data['balance_or_deficit'] === 'balance') {
            $data['balance'] = $data['balance_or_deficit_value'];
            $data['prediction'] = (new FuzzyMamdani($data['demand'], $data['balance_or_deficit_value']))->prediksiFix;
        }

        elseif($data['balance_or_deficit'] === 'deficit') {
            $data['deficit'] = $data['balance_or_deficit_value'];
            $data['prediction'] = (new FuzzyMamdani($data['demand'], 0, $data['balance_or_deficit_value']))->prediksiFix;
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

        if($data['balance_or_deficit'] === 'balance') {
            $data['balance'] = $data['balance_or_deficit_value'];
            $data['deficit'] = 0;
            $data['prediction'] = (new FuzzyMamdani($data['demand'], $data['balance_or_deficit_value']))->prediksiFix;
        }

        elseif($data['balance_or_deficit'] === 'deficit') {
            $data['balance'] = 0;
            $data['deficit'] = $data['balance_or_deficit_value'];
            $data['prediction'] = (new FuzzyMamdani($data['demand'], 0, $data['balance_or_deficit_value']))->prediksiFix;
        }

        $production->update($data);

        return redirect()
            ->route('productions.index')
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
        $data['productions'] = Production::all();

        $pdf = PDF::loadView('productions.pdf', $data);
        
        return $pdf->download('rekap-data-produksi.pdf');
    }
}
