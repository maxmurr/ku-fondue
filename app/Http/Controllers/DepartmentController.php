<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewany', Department::class);
        return view("departments.index", ['departments' => Department::get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Department::class);
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Department::class);
        $request->validate([
            'name' => ['required','max:32','min:8'],
        ]);

        $department = new Department();
        $department->name = $request->name;
        $department->save();

        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        $this->authorize('view', $department);
        return redirect()->route('departments.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $this->authorize('update', $department);
        return view('departments.edit',['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $this->authorize('update', $department);
        $request->validate([
            'name' => ['required','max:32'],
        ]);

        $department->name = $request->name;
        $department->save();

        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Department $department)
    {
        $this->authorize('delete',$department);
        $name = $request->input('name');
        if ($name <> $department->name)
            return redirect()->back()->withErrors('ชื่อหน่วยงานที่กรอกไม่ตรงกับชื่อหน่วยงานที่จะลบ')->withInput();
        if($department->users->count() > 0)
            return redirect()->back()->withErrors('ไม่สามารถลบหน่วยงานดังกล่าวได้ เนื่องจากยังมีผู้ใช้งานอยู่ในหน่วยงานนี้')->withInput();
        $department->delete();;
        return redirect()->route('departments.index');
    }
}
