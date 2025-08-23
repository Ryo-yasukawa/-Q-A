<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * 
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
         $keyword = $request->input('keyword');

        $query = Question::query()->with('user'); // 投稿者情報を取得

        if (!empty($keyword)) {
            $query->where('title', 'like', "%{$keyword}%")
                  ->orWhere('body', 'like', "%{$keyword}%");
        }

        $questions = $query->latest()->paginate(10);

        return view('home', compact('questions', 'keyword'));
    }
}