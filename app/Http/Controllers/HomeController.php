<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Term;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::with([
            'features.tags',
            'features.examples',
        ])->orderBy('name')->get();

        $terms = Term::orderBy('name')->get();

        return view('home.index', compact('categories', 'terms'));
    }
}
