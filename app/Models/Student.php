<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $table = "students";

    protected  $fillable  = array(
        "foto"
    );

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Courses(){
        return $this->belongsToMany(Course::class, "course_student");
    }
}
