<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $table = 'courses';
    public function Posts()
    {
        return $this->hasMany(Lesson::class)->where('active',1);
    }
}
