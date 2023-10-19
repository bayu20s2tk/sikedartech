<?php

namespace App\Http\Controllers;

use App\Models\ProjectBid;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectBidController extends Controller
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
        if (ProjectBid::where('project_id', $request['project_id'])->where('user_id', auth()->user()->id)->first()) {
            session()->flash('flash.banner', 'Kamu sudah pernah mengajukan!');

        } else {
            Validator::make($request->toArray(), [
                'project_id' => ['required'],
                'desc' => ['required', 'string'],
                'price' => ['required', 'numeric'],
            ])->validateWithBag('storeInformation');

            $request['user_id'] = auth()->user()->id;
            $request['status_id'] = ProjectBid::NOTSELECTED;

            ProjectBid::create($request->all());
            session()->flash('flash.banner', 'Ok!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectBid $projectBid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectBid $projectBid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectBid $projectBid)
    {
        dd($request->all(), $projectBid->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectBid $projectBid)
    {
        //
    }
}
