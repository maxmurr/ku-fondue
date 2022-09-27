<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',User::class);
        $user = User::all();
        return view('users.index',['users'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);
        return view('users.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update',$user);
        if($request->role === 'USER'){
            if($request->department <> null)
                return redirect()->back()->withErrors('User ต้องไม่สังกัดอยู่ในหน่วยงาน')->withInput();
            $user->name = $request->name;
            $user->role = $request->role;
            $user->department_id = null;
            $user->save();
        }
        else if($request->role === 'EMPLOYEE'){
            if($request->department === null)
                return redirect()->back()->withErrors('Employee จำเป็นต้องสังกัดอยู่ในหน่วยงาน')->withInput();
            $user->name = $request->name;
            $user->role = $request->role;
            $user->department_id = $request->department;
            $user->save();
        }
        return redirect()->route('users.index',['users'=>User::all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
