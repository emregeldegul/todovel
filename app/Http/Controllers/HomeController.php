<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tasks = Task::orderBy('updated_at', 'DESC')
            ->where('author', Auth::user()->id)
            ->where('pin', 1)
            ->where('status', 1)
            ->paginate(10);
        return view('home')->with('tasks', $tasks);
    }
}
