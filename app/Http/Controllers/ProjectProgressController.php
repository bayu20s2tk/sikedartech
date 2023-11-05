<?php

namespace App\Http\Controllers;

use App\Models\ProjectProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //        dd($request->all());
        Validator::make($request->toArray(), [
            'range' => ['required'],
            'desc' => ['required'],
        ])->validateWithBag('storeInformation');

        $request['user_id'] = auth()->user()->id;

        ProjectProgress::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectProgress $projectProgress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectProgress $projectProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectProgress $projectProgress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectProgress $projectProgress)
    {
        //
    }
}
