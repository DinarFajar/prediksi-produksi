<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Http\Requests\ProductionRequest;

class PredictionController extends Controller
{
    private $dir = 'predictions.';

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductionRequest $request)
    {
        //
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

        $production->update($data);

        return redirect()
            ->route('predictions.show', ['production' => $production->id])
            ->with('success', 'Data Prediksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function destroy(Production $production)
    {
        $production->update([
            'prediction' => 0,
            'production' => 0,
        ]);

        return redirect()
            ->route('predictions.index')
            ->with('success', 'Data Prediksi berhasil dihapus');
    }
}
