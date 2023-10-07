<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\PageCta;
use App\Models\PageFeature;
use App\Models\PageFeatureDetail;
use App\Models\PageHero;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class LandingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function welcome(): Response
    {
//        dd(Blog::latest()->take(6)->get());
        return Inertia::render('Landing/Welcome', [
            'course' =>  Inertia::lazy(fn () => Course::latest()->get()->take(8)),
            'blog' =>  Inertia::lazy(fn () => Blog::latest()->get()->take(6)),
        ]);
//        return Redirect::route('dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function course(): Response
    {
        return Inertia::render('Landing/Course', [
            'course' =>  Inertia::lazy(fn () => Course::latest()->get()),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function blog(): Response
    {
        return Inertia::render('Landing/Blog', [
            'blog' =>  Inertia::lazy(fn () => Blog::latest()->get()),
        ]);
    }
}
