<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // show dashboard to the user
    public function index() {
        // if(auth()->user()->isAdmin()){
            $courses = Course::with('course_category')->get();
        // }
        return view('user.dashboard', [
            "courses" => $courses
        ]);
    }
}
