<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Carousel;
use App\Models\Course;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Psy\Util\Str;
use Stephenjude\Wallet\Exceptions\InsufficientFundException;

class DashboardController extends Controller
{
    public function index() {
        switch(auth()->user()->role_id) {
            case(User::ADMIN):
                $course = Course::query();
                $courseMe = Course::query();
                $project = Project::query();
                $projectMe = Project::query();
                break;
            case(User::MENTOR):
                $course = Course::query()->where('user_id', auth()->user()->id);
                $courseMe = Course::query()->subscribedBy(auth()->user());
                $project = Project::query()->where('user_id', auth()->user()->id);
                $projectMe = Project::query()->where('worker_id', auth()->user()->id);
                break;
            case(User::USER):
                $course = Course::query()->subscribedBy(auth()->user());
                $courseMe = Course::query()->subscribedBy(auth()->user());
                $project = Project::query()->where('user_id', auth()->user()->id);
                $projectMe = Project::query()->where('worker_id', auth()->user()->id);
                break;
            default:
                dd('error');
        }

//        dd(
//            $course->get(),
//            $courseMe->get(),
//            $project->get(),
//            $projectMe->get()
//        );

        return Inertia::render('Dashboard/Index', [
            'user' => auth()->user(),
            'course' => $course->get(),
            'course_me' => $courseMe->get(),
            'project' => $project->get(),
            'project_me' => $projectMe->get(),
        ]);
    }


}
