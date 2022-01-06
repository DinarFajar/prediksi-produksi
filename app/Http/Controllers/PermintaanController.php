<?php

namespace App\Http\Controllers;

use App\Models\{Permintaan, Prediksi, Produksi};
use App\Http\Requests\PermintaanRequest;
use App\Libraries\FuzzyMamdani;

class PermintaanController extends Controller
{
    private $dir = 'permintaan.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['permintaan'] = Permintaan::all();

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
     * @param  \App\Http\Requests\PermintaanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermintaanRequest $request)
    {
        $data = $request->validated();

        $prediksiValue = null;

        if($data['sisa_or_kekurangan'] === 'sisa') {
            $data['sisa'] = $data['sisa_or_kekurangan_value'];
            
            $prediksiValue = (new FuzzyMamdani($data['permintaan'], $data['sisa_or_kekurangan_value']))->prediksiFix;
        }

        elseif($data['sisa_or_kekurangan'] === 'kekurangan') {
            $data['kekurangan'] = $data['sisa_or_kekurangan_value'];
            
            $prediksiValue = (new FuzzyMamdani($data['permintaan'], 0, $data['sisa_or_kekurangan_value']))->prediksiFix;
        }

        $permintaan = Permintaan::create($data);

        $prediksi = Prediksi::create([
            'permintaan_id' => $permintaan->id,
            'prediksi' => $prediksiValue,
        ]);

        Produksi::create(['prediksi_id' => $prediksi->id]);

        return redirect()
            ->route('permintaan.index')
            ->with('success', 'Data Permintaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function show(Permintaan $permintaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Permintaan $permintaan)
    {
        $data['permintaan'] = $permintaan;

        return view($this->dir.'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PermintaanRequest  $request
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function update(PermintaanRequest $request, Permintaan $permintaan)
    {
        $data = $request->validated();

        $prediksiValue = null;

        if($data['sisa_or_kekurangan'] === 'sisa') {
            $data['sisa'] = $data['sisa_or_kekurangan_value'];
            $data['kekurangan'] = 0;
            
            $prediksiValue = (new FuzzyMamdani($data['permintaan'], $data['sisa_or_kekurangan_value']))->prediksiFix;
        }

        elseif($data['sisa_or_kekurangan'] === 'kekurangan') {
            $data['sisa'] = 0;
            $data['kekurangan'] = $data['sisa_or_kekurangan_value'];
            
            $prediksiValue = (new FuzzyMamdani($data['permintaan'], 0, $data['sisa_or_kekurangan_value']))->prediksiFix;
        }

        $permintaan->update($data);
        $permintaan->prediksi->update(['prediksi' => $prediksiValue]);

        return redirect()
            ->route('permintaan.index')
            ->with('success', 'Data Permintaan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permintaan $permintaan)
    {
        $permintaan->prediksi->produksi->delete();

        $permintaan->prediksi->delete();

        $permintaan->delete();

        return redirect()
            ->route('permintaan.index')
            ->with('success', 'Data Permintaan berhasil dihapus');
    }
}
