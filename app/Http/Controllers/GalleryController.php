<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Requests\GalleryRequest;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    private $dir = 'galleries.';
    private $galleryDir = 'public/galleries/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['galleries'] = Gallery::latest()->get();

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
     * @param  \App\Http\Requests\GalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $path = $request->picture->store($this->galleryDir);

        Gallery::create(['filename' => basename($path)]);

        return redirect()
            ->route('galleries.index')
            ->with('success', 'Gambar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GalleryRequest  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        Storage::delete($this->galleryDir.$gallery->filename);

        $gallery->delete();

        return redirect()
            ->route('galleries.index')
            ->with('success', 'Gambar berhasil dihapus');
    }
}
