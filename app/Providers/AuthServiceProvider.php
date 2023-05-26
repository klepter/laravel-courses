<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('user', function (User $user) {
            return $user->role === 'user';
        });

        Gate::define('subscribeCourse', function (User $user, Course $course) {
            return $course->isActive()
                && $course->getFreeAmount() !== 0
                && in_array($course->id, array_map(function ($x) {
                    return $x['id'];
                }, $user->courses()->get()->toArray())) === false
                && Gate::allows('user');
        });

        Gate::define('cancelSubscribe', function (User $user, Course $course) {
            return Carbon::parse($course->start_date)->diffInHours(Carbon::now()->addHours(5)) > 24
                && in_array($course->id, array_map(function ($x) {
                    return $x['id'];
                }, $user->courses()->get()->toArray())) !== false
                && $course->isActive();
        });

        Gate::define('deleteCourse', function (User $user, Course $course) {
           return Gate::allows('admin')
               && $course->getFreeAmount() === $course->amount;
        });
    }
}
