<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;

class ProjectBillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd(Project::where('worker_id', '!=', null)->latest()->get()->toArray());
        return Inertia::render('ProjectBilling/Index', [
            'project' => Project::query()
                ->whereIn('status_id', [Project::FINISH, Project::PAID])
                ->latest()
                ->when(Req::input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->paginate(8)
                ->withQueryString(),
        ]);
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
