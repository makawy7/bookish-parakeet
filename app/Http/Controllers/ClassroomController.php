<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::with('grade')->get();
        return view("admin.classrooms.index", ["classrooms" => $classrooms]);
    }
}
