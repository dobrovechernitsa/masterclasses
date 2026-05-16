<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MasterClass;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function cabinet()
    {
        if (!auth()->user()->isInstructor()) {
            abort(403);
        }
        
        $allCategories = Category::all();
        
        $masterClasses = auth()->user()->masterClasses()
            ->with(['bookings.user', 'category'])
            ->orderBy('date')
            ->orderBy('time_slot')
            ->get();
            
        return view('instructor.cabinet', compact('masterClasses', 'allCategories'));
    }
}