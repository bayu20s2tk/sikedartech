<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseSubscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Req;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CourseSubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd(CourseSubscribe::latest()->get());
        return Inertia::render('CourseSubscribe/Index', [
            'subscribe' => CourseSubscribe::query()->with('user', 'course')
                ->latest()
                ->when(Req::input('search'), function ($query, $search) {
                    $query->where('user.name', 'like', '%' . $search . '%');
                })->paginate(8)
                ->withQueryString(),
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
        Validator::make($request->toArray(), [
            'course_id' => ['required'],
            'photo' => ['required']
        ])->validateWithBag('storeInformation');

        $course = CourseSubscribe::where('course_id', $request['course_id'])->where('user_id', auth()->user()->id)->first();

        if ($course) {
            $media = Media::find($course->media[0]->id);
            $course->deleteMedia($media->id);
            $course->addMedia($request['photo'])->toMediaCollection();
            $course->update([
                'status_id' => CourseSubscribe::REQUEST,
            ]);
        } else {
            $request['user_id'] = auth()->user()->id;
            $request['status_id'] = CourseSubscribe::REQUEST;

            $sub = CourseSubscribe::create($request->all());
            $sub->addMedia($request['photo'])->toMediaCollection();

        }
        session()->flash('flash.banner', 'sabar ya, sedang di proses!');


//        return Redirect::route('courseCategory.index', []);
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseSubscribe $courseSubscribe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseSubscribe $courseSubscribe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseSubscribe $courseSubscribe)
    {
//        dd($request->all(), $courseSubscribe);
        $user = User::where('id', $courseSubscribe['user_id'])->first();
        $course = Course::where('id', $courseSubscribe['course_id'])->first();

//dd($owner);
        if ($request['status_id'] == CourseSubscribe::ACCEPT) {
            $user->subscribe($course);
            $course->user->deposit($course->price);
            $courseSubscribe->update(['status_id' => CourseSubscribe::ACCEPT]);
        } elseif ($request['status_id'] == CourseSubscribe::REJECT) {
            $courseSubscribe->update(['status_id' => CourseSubscribe::REJECT]);
            $user->unsubscribe($course);
        } else {
            $courseSubscribe->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseSubscribe $courseSubscribe)
    {
        //
    }
}
