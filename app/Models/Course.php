<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['title', 'description', 'amount', 'start_date', 'code_id', 'image'];

    public function users() {
        return $this->belongsToMany(User::class, 'users_courses', 'course_id', 'user_id');
    }

    public function language() {
        return $this->belongsTo(Language::class);
    }

    public function getFreeAmount() {
        return $this->amount - count($this->users()->get());
    }

    public function isActive(): bool
    {
        return Carbon::now() < Carbon::parse($this->start_date);
    }

    static public function add($data) {
        return Course::create($data);
    }
}
