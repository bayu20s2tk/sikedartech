<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('CourseCategory/Index', [
           'category' => CourseCategory::latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CourseCategory/CreateEdit', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->toArray(), [
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string'],
            'icon' => ['required', 'string'],
        ])->validateWithBag('storeInformation');

        CourseCategory::create($request->all());
        return Redirect::route('courseCategory.index', []);
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseCategory $courseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseCategory $courseCategory)
    {
        return Inertia::render('CourseCategory/CreateEdit', [
            'category' => $courseCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseCategory $courseCategory)
    {
        $courseCategory->update($request->all());
        return Redirect::route('courseCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCategory $courseCategory)
    {
        $courseCategory->delete();

        return Redirect::route('courseCategory.index');
    }
}
