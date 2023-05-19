<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public $table = "courses";

    protected  $fillable  = array(
        "name",
        "hours",
        "price",
        "percent_teacher",
        "start_date",
        "finish_date",
    );

    public function Students(){
        return $this->belongsToMany(Student::class, "course_student");
    }
}
