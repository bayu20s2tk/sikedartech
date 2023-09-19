<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\AppSetting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {

        return Inertia::render('Profile/Index', [

        ]);
    }
}
