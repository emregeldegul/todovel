<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Validator;
use Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Task::orderBy('status', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->where('author', Auth::user()->id)
            ->get();

        return View('tasks.index')->with('tasks', $tasks);
    }

    public function create()
    {
        return View('tasks.create');
    }

    public function store(Request $request)
    {
        $this -> validate($request, [
            'taskTitle'=> 'required|min:5|max:50',
        ]);

        $task = new Task;
        $task -> title = $request -> taskTitle;
        $task -> content = $request -> taskDesc;
        $task -> status = $request -> taskStatus;
        $task -> pin = $request -> taskPin;
        $task -> author = Auth::user()->id;
        $task -> save();

        return redirect()->route('tasks.index');

    }

    public function show(Task $task)
    {
        if (Auth::user()->id == $task->author) {
            return view('tasks.edit')->with('task', $task);
        }else {
            abort(403);
        }

    }

    public function edit(Task $task)
    {
        if (Auth::user()->id == $task->id) {
            return view('tasks.edit')->with('task', $task);
        }else{
            abort(403);
        }
    }

    public function update(Request $request, Task $task)
    {
        if (Auth::user()->id != $task->id) {
            abort(403);
        }

        $rules = [
            'taskTitle'=> 'required|min:5|max:50',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $task -> title = $request -> taskTitle;
        $task -> content = $request -> taskDesc;
        $task -> status = $request -> taskStatus;
        $task -> pin = $request -> taskPin;
        $task -> save();

        return response(['change' => 'ok'], 200);
    }

    public function destroy(Task $task)
    {
        if (Auth::user()->id != $task->id) {
            abort(403);
        }

        $task -> delete();

        return redirect()->route('tasks.index');
    }

    public function status(Task $task){
        if ($task->status == 1) {
            $task->status = 0;
        }elseif ($task->status == 0) {
            $task->status = 1;
        }

        $task->save();

        return redirect()->route('tasks.index');
    }
}
