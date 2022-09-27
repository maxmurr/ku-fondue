<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProblemController extends Controller
{
    // Create Index
    public function index()
    {
        $problems = Problem::latest()->paginate(20); // sort ล่าสุดขึ้นก่อน
        return view("problems.index", ['problems' => $problems]);
    }

    public function sortCountLike()
    {
        $problems = Problem::withCount('user_upvotes')->orderBy('user_upvotes_count', 'desc')->paginate(20);
        return view("problems.index", ['problems' => $problems]);
    }

    // view your problems
    public function your_problems()
    {
        $problems = Problem::where('owner_id', Auth::id())->latest()->paginate(20);
        return view("problems.your_problems", ['problems' => $problems]);
    }

    // Create resource
    public function create()
    {
        if (Auth::check()) {
            return view('problems.create');
        }
        return redirect()->route('login');
    }

    // Store resource
    public function store(Request $request)
    {
        $this->authorize('create', Problem::class);

        $request->validate([
            'title' => ['required', 'max:32', 'min:8'],
            'type' => 'required',
            'detail' => ['required', 'max:500'],
            'location' => ['required', 'max:32'],
            'department' => 'required',
            'picture_path' => ['required', 'file', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048']
        ]);

        $problem = new Problem;
        $problem->title = $request->title;
        $problem->type = $request->type;
        $problem->detail = $request->detail;
        $problem->location = $request->location;
        $problem->phone_number = $request->phone_number;
        $problem->department_id = $request->department;
        $problem->status = "Pending";

        $imageName = time() . '.' . $request->picture_path->extension();

        // Public Folder
        $request->picture_path->move(public_path('images'), $imageName);
        $problem->picture_path = 'images/' . $imageName;
        $problem->owner_id = Auth::id();
        $problem->category_id = $request->input('department');
        $problem->save();

        return redirect()->route('problems.index', ['problem' => $problem->id])->with('success', 'แจ้งปัญหาสำเร็จ')->with('picture_path', $imageName);
    }

    public function show(Problem $problem)    // Dependency Injection
    {
        return view('problems.show', ['problem' => $problem]);
    }

    public function edit(Problem $problem)
    {
        if (Auth::id() === $problem->owner_id)
            return view('problems.edit', ['problem' => $problem]);
        return redirect()->back()->withInput();
    }

    public function update(Request $request, Problem $problem)
    {
        $this->authorize('update', $problem);
        $request->validate([
            'title' => ['required', 'max:32', 'min:8'],
            'type' => 'required',
            'detail' => ['required', 'max:500'],
            'location' => ['required', 'max:32'],
            'department' => 'required',
            'phone_number' => ['max:12'],
            'picture_path' => ['file', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048']
        ]);

        $problem->title = $request->title;
        $problem->type = $request->type;
        $problem->detail = $request->detail;
        $problem->location = $request->location;
        $problem->phone_number = $request->phone_number;
        $problem->department_id = $request->department;

        $problem->category_id = $request->input('department');

        if ($request->picture_path != "") {
            $imageName = time() . '.' . $request->picture_path->extension();

            $request->picture_path->move(public_path('images'), $imageName);
            $problem->picture_path = 'images/' . $imageName;
        }

        $problem->save();

        return redirect()->route('problems.show', ['problem' => $problem->id])->with('success', 'แก้ไขสำเร็จ');
    }

    public function destroy(Request $request, Problem $problem)
    {
        $this->authorize('delete', $problem);
        $title = $request->input('title');
        if ($title == $problem->title) {
            $problem->delete();
            return redirect()->route('problems.index');
        }

        return redirect()->back();
    }

    public function upvote(Problem $problem)
    {
        $user = Auth::user();
        if ($user->problem_upvotes()->where('problem_id', $problem->id)->exists())
            $user->problem_upvotes()->detach($problem);
        else
            $user->problem_upvotes()->attach($problem);
        return redirect()->back()->withInput();
    }

    public function ignoredProblem(Problem $problem)
    {
        $this->authorize('changeStatus', $problem);
        $problem->status = 'Ignored';
        $problem->save();
        return redirect()->back()->withInput();
    }

    public function acceptProblem(Problem $problem)
    {
        $this->authorize('changeStatus', $problem);
        $problem->status = 'In Progress';
        $problem->save();
        return redirect()->back()->withInput();
    }

    public function completeProblem(Problem $problem)
    {
        $this->authorize('changeStatus', $problem);
        $problem->status = 'Complete';
        $problem->user_id = Auth::id();
        $problem->save();
        return redirect()->back()->withInput();
    }

    public function dashboard()
    {
        $problems = Problem::all();

        $eachTypeCounter = [];

        $eachTypeCounter[0] = $problems->where('type', 'การเดินทางภายในมหาวิทยาลัย')->where('created_at', '>', now()->subDays(30)->endOfDay())->count();
        $eachTypeCounter[1] = $problems->where('type', 'อุบัติเหตุ')->where('created_at', '>', now()->subDays(30)->endOfDay())->count();
        $eachTypeCounter[2] = $problems->where('type', 'ภัยพิบัติ')->where('created_at', '>', now()->subDays(30)->endOfDay())->count();
        $eachTypeCounter[3] = $problems->where('type', 'กองทุนเงินให้กู้ยืมเพื่อการศึกษา(กยศ.)')->where('created_at', '>', now()->subDays(30)->endOfDay())->count();
        $eachTypeCounter[4] = $problems->where('type', 'เหตุขัดข้องภายในมหาวิทยาลัย')->where('created_at', '>', now()->subDays(30)->endOfDay())->count();
        $eachTypeCounter[5] = $problems->where('type', 'อื่นๆ')->where('created_at', '>', now()->subDays(30)->endOfDay())->count();


        return view("problems.dashboard", ['typeData' => $eachTypeCounter]);
    }
}
