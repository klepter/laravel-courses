<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Language;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    public function show(Request $request, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $userSubscribeCourse = array_search($id, array_map(function ($x) {
            return $x['id'];
        }, $request->user()->courses()->get()->toArray()));
        $course = Course::findOrFail($id);
        return view('course', compact('course', 'userSubscribeCourse'));
    }

    public function showAddForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $languages = Language::all();
        return view('course.add', compact('languages'));
    }

    public function add(Request $request)
    {
//        $dateAfterDay = Carbon::now()->addDay()->format('Y-m-d H:i');
        $request->validate([
            'title' => ['required', 'max:255', 'unique:' . Course::class],
            'description' => ['required'],
            'amount' => ['required', 'integer', 'min:1'],
            'code_id' => ['required', 'integer'],
            'start_date' => ['required', 'date']
        ]);

        if ($request->file('image')) {
            $path = $request->file('image')->store('images', 'public');
            $request->image = mb_substr($path, 7);
        } else {
            $request->image = 'no_image.jpg';
        }

        $course = Course::add([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'start_date' => $request->start_date,
            'code_id' => $request->code_id,
            'image' => $request->image
        ]);

        return redirect('/course/' . $course->id);
    }

    public function showEditForm($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $course = Course::findOrFail($id);
        $languages = Language::all();
        return view('course.edit', compact('languages', 'course'));
    }

    public function edit(Request $request, $id)
    {
        $course = Course::findOrFail($id);
//        $dateAfterDay = Carbon::now()->addDay()->format('Y-m-d H:i');
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'amount' => ['required', 'integer', 'min:1'],
            'code_id' => ['required', 'integer'],
            'start_date' => ['required', 'date']
        ]);

        if ($request->file('image')) {
            $path = $request->file('image')->store('images', 'public');
            $request->image = mb_substr($path, 7);
        } else {
            $request->image = $course->image;
        }

        $course->fill([
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'start_date' => $request->start_date,
            'code_id' => $request->code_id,
            'image' => $request->image
        ]);
        $course->save();

        return redirect('/course/' . $course->id);
    }

    public function delete($id) {
        $course = Course::findOrFail($id);
        if(!Gate::allows('deleteCourse', $course)) {
            abort(403);
        }
        $course->delete();

        return redirect('/admin');
    }

    public function subscribe(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        if(!Gate::allows('subscribeCourse', $course)) {
            abort(403);
        }
        $user = User::findOrFail($request->user()->id);
        $user->courses()->attach($course);

        return redirect('/course/' . $id);
    }

    public function cancelSubscribe(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        if(!Gate::allows('cancelSubscribe', $course)) {
            abort(403);
        }
        $request->user()->courses()->detach($course);

        return redirect('/');
    }

    public function userCourses(Request $request)
    {
        $userCourses = $request->user()->courses()->get();
        return view('user.courses', compact('userCourses'));
    }
}
