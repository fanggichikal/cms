<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
        {
            return view('backend.dashboard.index',[
                'total_articles' => Article::count(),
                'total_category' => Category::count(),
                'latest_articles' => Article::with('Category')->whereStatus(1)->latest()->take(10)->get(),
                'popular_articles' => Article::with('Category')->whereStatus(1)->orderBy('views','desc')->take(10)->get()
            ]);
        }
}
