<?php

namespace App\Http\Controllers;

use App\Models\Prediksi;
use App\Http\Requests\PrediksiRequest;
use PDF;

class PrediksiController extends Controller
{
    private $dir = 'prediksi.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['prediksi'] = Prediksi::all();

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
     * @param  \App\Http\Requests\PrediksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrediksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prediksi  $prediksi
     * @return \Illuminate\Http\Response
     */
    public function show(Prediksi $prediksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prediksi  $prediksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Prediksi $prediksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PrediksiRequest  $request
     * @param  \App\Models\Prediksi  $prediksi
     * @return \Illuminate\Http\Response
     */
    public function update(PrediksiRequest $request, Prediksi $prediksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prediksi  $prediksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prediksi $prediksi)
    {
        //
    }

    public function print()
    {
        $data['prediksi'] = Prediksi::all();

        $pdf = PDF::loadView('prediksi.pdf', $data);
        
        return $pdf->download('rekap-hasil-prediksi.pdf');
    }
}
