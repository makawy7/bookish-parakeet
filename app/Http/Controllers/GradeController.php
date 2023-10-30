<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        return view("admin.grades.index");
    }

    public function create()
    {
        return view("admin.grades.create");
    }
}
