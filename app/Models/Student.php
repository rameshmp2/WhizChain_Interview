<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'lms_students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','address','email','grade_id','register_date','status',
    ];

    /**
     * Get the grade record associated with the student.
     */
    public function grade()
    {
        return $this->hasOne('App\Models\Grade','id','grade_id');
    }
}
