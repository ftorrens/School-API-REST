<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $table = "students";

    protected  $fillable  = array(
        "name",
        "last_name",
        "foto"
    );

    public function Courses(){
        return $this->belongsToMany(Course::class, "course_student");
    }
}
