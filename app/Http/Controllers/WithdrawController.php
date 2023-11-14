<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Req;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Withdraw/Index', [
           'wd' => Withdraw::query()
               ->latest()
               ->when(Req::input('search'), function ($query, $search) {
                   $query->where('name', 'like', '%' . $search . '%');
               })->paginate(8)
               ->withQueryString(),
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
            'amount' => ['required', 'integer', 'min:10000', 'max:1000000'],
        ])->validateWithBag('storeInformation');

//        dd($request->toArray());
        $request['status_id'] = Withdraw::REQUEST;
        $request['user_id'] = auth()->user()->id;
        Withdraw::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Withdraw $withdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Withdraw $withdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Withdraw $withdraw)
    {
//        dd($request->toArray(), $withdraw->toArray());
//        $user = $withdraw->user;
        if ($request['status_id'] == Withdraw::SEND) {
            $withdraw->user->withdraw($withdraw->amount);
        }
        $withdraw->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Withdraw $withdraw)
    {
        //
    }
}
