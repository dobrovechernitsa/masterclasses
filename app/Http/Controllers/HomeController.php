<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $userBookings = collect();
        if (auth()->check()) {
            $userBookings = auth()->user()->bookings()
                ->with(['masterClass.instructor', 'masterClass.category'])
                ->where('status', 'confirmed')
                ->whereHas('masterClass', function ($query) {
                    $query->where('date', '>=', now());
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('home', compact('categories', 'userBookings'));
    }
}
