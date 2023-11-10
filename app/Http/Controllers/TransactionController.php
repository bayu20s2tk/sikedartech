<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Transaction/Index', [
//            'course' =>  Inertia::lazy(fn () => $course),
            'course' => Course::query()
                ->subscribedBy(auth()->user())
                ->orWhere('user_id', auth()->user()->id)
                ->latest()
                ->when(Req::input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->paginate(8)
                ->withQueryString(),

            'project' => Project::query()
                ->where('user_id', auth()->user()->id)
                ->orWhere('worker_id', auth()->user()->id)
                ->latest()
                ->when(Req::input('searchProject'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->paginate(8)
                ->withQueryString(),
        ]);
    }

}
