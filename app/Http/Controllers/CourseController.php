<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Course/Index', [
//            'course' => Course::latest()->paginate(20),
            'course' =>  Inertia::lazy(fn () => Course::latest()->get()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Course/CreateEdit', [
            'selectCategory' => CourseCategory::all()->pluck('name', 'id'),
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

        return Redirect::route('course.edit', [
            'course' => Course::create($request->all())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
//        $comment = auth()->user()->attachLikeStatus($course->comment);
        $comment = auth()->user()->attachVoteStatus($course->comment);
//        $comment = $comment->toArray();
//        dd($comment);
        if (auth()->user()->hasSubscribed($course)) {
            return Inertia::render('Course/Show', [
                'course' => $course,
                'comment' => $comment
            ]);
        } else {
            return Inertia::render('Course/Join', [
                'course' => $course
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return Inertia::render('Course/CreateEdit', [
            'course' => $course,
            'gallery' => Gallery::all(),
            'selectCategory' => CourseCategory::all()->pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
//        dd($request->all(), $course);
        $course->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return Redirect::route('course.index');
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

        $courseHero = Course::find($request['id']);
        $courseHero->addMedia($request['photo'])->toMediaCollection();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return void
     */
    public function deleteHero($id)
    {
        $media = Media::find($id);
        $model = Course::find($media->model_id);
        $model->deleteMedia($media->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return void
     */
    public function subscribe(Request $request, Course $course)
    {
        dd($request->all(), $course);
//        Validator::make($request->toArray(), [
//            'photo' => ['required'],
//        ])->validateWithBag('storeInformation');
//        auth()->user()->follow($course);
        auth()->user()->subscribe($course);
    }
}
