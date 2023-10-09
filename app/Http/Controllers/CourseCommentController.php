<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\CourseComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseCommentController extends Controller
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
            'comment' => ['required', 'string'],
        ])->validateWithBag('storeInformation');

        $request['user_id'] = auth()->user()->id;
        $request['content'] = $request['comment'];

        CourseComment::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseComment $courseComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseComment $courseComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseComment $courseComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseComment $courseComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function like(CourseComment $courseComment)
    {
//        dd($courseComment);
//        auth()->user()->toggleLike($courseComment);
//        if (auth()->user()->hasVoted($courseComment)) {
//            auth()->user()->cancelVote($courseComment);
//        } else {
//            auth()->user()->cancelVote($courseComment);
//            auth()->user()->upvote($courseComment);
//        }
//        match (auth()->user()->hasVoted($courseComment)) {
//            true => auth()->user()->cancelVote($courseComment),
//            false => auth()->user()->upvote($courseComment),
//        };
        auth()->user()->cancelVote($courseComment);
        auth()->user()->upvote($courseComment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function dislike(CourseComment $courseComment)
    {
        auth()->user()->cancelVote($courseComment);
        auth()->user()->downvote($courseComment);
//        match (auth()->user()->hasVoted($courseComment)) {
//            true => auth()->user()->cancelVote($courseComment),
//            false => auth()->user()->downvote($courseComment),
//        };
    }
}
