<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('home', compact('categories'));
    }

    public function show(Category $category)
    {
        $allCategories = Category::all();
        
        $masterClasses = $category->masterClasses()
            ->with(['instructor', 'bookings'])
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('time_slot')
            ->get();
            
        return view('categories.show', compact('category', 'masterClasses', 'allCategories'));
    }
}