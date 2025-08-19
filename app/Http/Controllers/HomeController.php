<?php
namespace App\Http\Controllers;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $latest = Product::where('is_published', true)
            ->latest('published_at')->take(12)->get();
        return view('home', compact('latest'));
    }
}
