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
use Illuminate\Support\Facades\Request as Req;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        switch(auth()->user()->role_id) {
            case(User::ADMIN):
                $project = Project::query();
                $projectMe = Project::query()->where('user_id', auth()->user()->id);
                break;
            case(User::MENTOR):
                $project = Project::query()->where('worker_id', auth()->user()->id);
                $projectMe = Project::query()->where('user_id', auth()->user()->id);
                break;
            case(User::USER):
                $project = Project::query()->where('worker_id', auth()->user()->id);
                $projectMe = Project::query()->where('user_id', auth()->user()->id);
                break;
            default:
                dd('error');
        }

        return Inertia::render('Project/Index', [
//            'project' =>  Inertia::lazy(fn () => $project),
//            'projectMe' => Inertia::lazy(fn () => $projectMe),
            'project' => $project
                ->latest()
                ->when(Req::input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->paginate(8)
                ->withQueryString(),

            'projectMe' => $projectMe
                ->latest()
                ->when(Req::input('searchMe'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->paginate(8)
                ->withQueryString(),
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
//        dd($project->toArray());
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

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return void
     */
    public function addMedia(Request $request)
    {
//        dd($request->all());

        $project = Project::find($request['id']);
        $project->addMedia($request['media'])->toMediaCollection('media');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return void
     */
    public function deleteMedia($id)
    {
        $media = Media::find($id);
        $model = Project::find($media->model_id);
        $model->deleteMedia($media->id);
    }
}
