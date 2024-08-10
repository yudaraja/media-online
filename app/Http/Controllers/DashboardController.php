<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil 4 berita dengan performa terbaik berdasarkan jumlah views
        $topNews = News::orderBy('views', 'desc')->take(4)->get();

        // Total statistik
        $totalNews = News::count();
        $totalCategories = Category::count();
        $totalAdmins = User::count();
        $totalViews = News::sum('views');

        return view('admin.dashboard.dashboard', compact('topNews', 'totalViews', 'totalNews', 'totalCategories', 'totalAdmins'));
    }


}
