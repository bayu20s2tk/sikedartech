<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        switch(auth()->user()->role_id) {
            case(User::ADMIN):
                $project = Project::latest()->get();
                $projectMe = Project::where('user_id', auth()->user()->id)->get();
                break;
            case(User::MENTOR):
                $project = Project::where('worker_id', auth()->user()->id)->get();
                $projectMe = Project::where('user_id', auth()->user()->id)->get();
                break;
            case(User::USER):
                $project = Project::where('worker_id', auth()->user()->id)->get();
                $projectMe = Project::where('user_id', auth()->user()->id)->get();
                break;
            default:
                dd('error');
        }

        return Inertia::render('Project/Index', [
            'project' =>  Inertia::lazy(fn () => $project),
            'projectMe' => Inertia::lazy(fn () => $projectMe),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Project/CreateEdit', [
            'gallery' => Gallery::all(),
            'selectDay' => Project::DAY,
            'selectCategory' => ProjectCategory::all()->pluck('name', 'id'),
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

        Project::create($request->all());
        return Redirect::route('project.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
//        dd($project);
        return Inertia::render('Project/Show', [
            'project' => $project,
            'chat' => ProjectChat::where('project_id', $project->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return Inertia::render('Project/CreateEdit', [
            'project' => $project,
            'gallery' => Gallery::all(),
            'selectDay' => Project::DAY,
            'selectCategory' => ProjectCategory::all()->pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
//        dd($request->all(), $project);
        $project->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return Redirect::route('project.index');
    }
}
