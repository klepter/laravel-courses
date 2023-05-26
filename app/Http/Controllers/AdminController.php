<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdminPanel()
    {
        $languages = Language::all();
        foreach ($languages as $language) {
            $courses[$language->title] = $language->courses()->get();
        }
        return view('admin.panel', compact('courses'));
    }

    public function showCourseUsers($id)
    {
        $course = Course::findOrFail($id);
        $course['users'] = $course->users()->get();
        return view('admin.course-users', compact('course'));
    }

    public function cancelSubscribe($course_id, $user_id)
    {
        $course = Course::findOrFail($course_id);
        $user = User::findOrFail($user_id);
        $user->courses()->detach($course);

        return redirect('/');
    }
}
