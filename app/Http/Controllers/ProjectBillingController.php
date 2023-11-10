<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Req;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProjectBillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd(Project::whereNotIn('status_id', [Project::REQUEST, Project::OPEN])->latest()->get()->toArray());
        return Inertia::render('ProjectBilling/Index', [
            'project' => Project::query()
                ->whereNotIn('status_id', [Project::REQUEST, Project::OPEN])
                ->latest()
                ->when(Req::input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->paginate(8)
                ->withQueryString(),
        ]);
    }

    public function store(Request $request)
    {
//        dd($request->toArray());
        if ($request['status_id'] == Project::SELECTED) {
            Validator::make($request->toArray(), [
                'project_id' => ['required'],
                'photo' => ['required'],
                'status_id' => ['required']
            ])->validateWithBag('storeInformation');

            $project = Project::find($request['project_id']);

//            if ($project->media) {
//                $media = Media::find($project->media[0]->id);
//                $project->deleteMedia($media->id);
//            }
            $project->update($request->all());
            $project->addMedia($request['photo'])->toMediaCollection('ownerToApp');
        } elseif ($request['status_id'] == Project::ONGOING) {
            $project = Project::find($request['project_id']);
            $project->user->deposit($project->price);
            $project->update($request->all());
        } elseif ($request['status_id'] == Project::PAID) {
            $project = Project::find($request['project_id']);
            $project->user->withdraw($project->price);
            $project->worker->deposit($project->price);
            $project->update($request->all());
        } else {
            $project = Project::find($request['project_id']);
            $project->update($request->all());
        }




    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//        dd($request->all());
        $project = Project::find($request['project_id']);
        $project->update($request->all());
    }
}
