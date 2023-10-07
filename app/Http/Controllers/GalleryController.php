<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        Inertia::lazy(fn () => Gallery::all())
        return Inertia::render('Gallery/Index', [
            'gallery' => Gallery::all(),
        ]);
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
//        dd($request->all());
        Validator::make($request->toArray(), [
            'photo' => ['required'],
        ])->validateWithBag('storeInformation');

        $request['user_id'] = auth()->user()->id;

        $img = Gallery::create($request->all());
        $img->addMedia($request['photo'])->toMediaCollection();

//        return Redirect::route('gallery.edit', [
//            'blog' => Blog::create($request->all())
//        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
//        dd($gallery);
//        $gallery->deleteMedia(0);
        $gallery->delete();
    }
}
