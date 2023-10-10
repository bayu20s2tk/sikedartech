<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ProjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('ProjectCategory/Index', [
            'category' => ProjectCategory::latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('ProjectCategory/CreateEdit', [

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

        ProjectCategory::create($request->all());
        return Redirect::route('projectCategory.index', []);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectCategory $projectCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectCategory $projectCategory)
    {
        return Inertia::render('ProjectCategory/CreateEdit', [
            'category' => $projectCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectCategory $projectCategory)
    {
        $projectCategory->update($request->all());
        return Redirect::route('projectCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectCategory $projectCategory)
    {
        $projectCategory->delete();

        return Redirect::route('projectCategory.index');
    }
}
