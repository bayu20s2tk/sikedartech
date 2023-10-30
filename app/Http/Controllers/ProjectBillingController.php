<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
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
            'project' => Project::where('status_id', Project::FINISH)
                ->orWhere('status_id', Project::PAID)
                ->latest()->get()
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
