<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $userCourses = [];
        if (Auth::check()) {
            $user = $request->user();
            $userCourses = $user->courses()->get();
        }
        $courses = Course::all();
        if ($request->filter) {
            if ($request->filter == 'active') {
                $courses = $courses->filter(function ($x) {
                    return $x->isActive() && $x->getFreeAmount() !== 0;
                })->values();
            } else if ($request->filter == 'past') {
                $courses = $courses->filter(function ($x) {
                    return !$x->isActive();
                })->values();
            } else if ($request->filter == 'full_amount') {
                $courses = $courses->filter(function ($x) {
                    return $x->getFreeAmount() === 0;
                })->values();
            }
        }
        $filter = $request->filter ?? '';
        return view('index', compact('courses', 'userCourses', 'filter'));
    }

    public function courses($course_code)
    {
        $language = Language::where('code', $course_code)->first();
        if (!$language) {
            abort(404);
        }
        $courses = $language->courses()->get();
        return view('courses', compact('courses', 'language'));
    }
}
