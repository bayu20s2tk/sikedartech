<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Blog/Index', [
            'blog' => Blog::latest()->paginate(20),
//            'category' => BlogCategory::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Blog/CreateEdit', [
            'selectCategory' => BlogCategory::all()->pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->toArray(), [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('storeInformation');

        $request['user_id'] = auth()->user()->id;
        $request['status'] = true;
        $request['slug'] = Str::slug($request['name'], '-');

        return Redirect::route('blog.edit', [
            'blog' => Blog::create($request->all())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return Inertia::render('Blog/Show', [
            'blog' => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return Inertia::render('Blog/CreateEdit',
            [
                'blog' => $blog,
                'selectCategory' => BlogCategory::all()->pluck('name', 'id')
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $blog->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
//        $blog = Blog::find($request['id']);
        $blog->delete();

        return Redirect::route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return void
     */
    public function addHero(Request $request)
    {
        Validator::make($request->toArray(), [
            'photo' => ['required'],
        ])->validateWithBag('storeHero');

        $blogHero = Blog::find($request['id']);
        $blogHero->addMedia($request['photo'])->toMediaCollection();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $blogHero
     * @return void
     */
    public function deleteHero($blogHero, $id)
    {
//        dd($blogHero, $id);
        $media = Media::find($id);
//        dd($media);
        $model = Blog::find($media->model_id);
        $model->deleteMedia($media->id);

//        $hero = Blog::find($blogHero);
//        $hero->media[$id]->delete();
    }

}
