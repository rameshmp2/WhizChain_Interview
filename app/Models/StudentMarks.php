<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentMarks extends Model
{
    protected $table = 'lms_student_marks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id','marks'
    ];
}
