<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['title'];

    public function courses() {
        return $this->hasMany(Course::class, 'code_id');
    }
}
