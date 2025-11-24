<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
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
        $query = Question::where('is_visible', 1)->with('user');

         
        if (!empty($keyword)) {
           $query->where(function($q) use ($keyword) {
        $q->where('title', 'like', "%{$keyword}%")
          ->orWhere('body', 'like', "%{$keyword}%");
        });
    }

    if ($request->filled('from_date')) {
        $fromDate = $request->from_date;
        $query->whereDate('created_at', '>=', $fromDate);
    }

        $questions = $query->latest()->paginate(4);

        return view('home', compact('questions', 'keyword'));
    }
}