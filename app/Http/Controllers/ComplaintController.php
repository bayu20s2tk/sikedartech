<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Req;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd(Complaint::all()->toArray());
        return Inertia::render('Complaint/Index', [
            'complaint' => Complaint::latest()->paginate(8)
        ]);
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
            'comment_id' => ['required'],
            'category_id' => ['required'],
            'desc' => ['required']
        ])->validateWithBag('storeInformation');

        $request['user_id'] = auth()->user()->id;
        $request['status_id'] = Complaint::REQUEST;

        Complaint::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
//        dd($request->toArray(), $complaint);
        if ($request['status_id'] == true) {
            $user = User::find($request['user_id']);
            $user->update([
                'status_id' => User::BANNED
            ]);
            $complaint->update([
                'status_id' => Complaint::BANNED
            ]);
        } else {
            $complaint->update([
                'status_id' => Complaint::IGNORE
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        //
    }
}
