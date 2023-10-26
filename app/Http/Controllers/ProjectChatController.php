<?php

namespace App\Http\Controllers;

use App\Models\ProjectChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectChatController extends Controller
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
        Validator::make($request->toArray(), [
            'message' => ['required', 'string'],
        ])->validateWithBag('storeInformation');

        $request['user_id'] = auth()->user()->id;

        ProjectChat::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectChat $projectChat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectChat $projectChat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectChat $projectChat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectChat $projectChat)
    {
        //
    }
}
