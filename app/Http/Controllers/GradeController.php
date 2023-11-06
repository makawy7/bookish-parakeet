<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        return view("admin.grades.index", ["grades" => $grades]);
    }

    public function create()
    {
        return view("admin.grades.create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name_ar" => "required",
            "name_en" => "required",
            "notes" => "sometimes",
        ]);
        $grade = new Grade;
        $grade->setTranslation("name", "en", $request->name_en);
        $grade->setTranslation("name", "ar", $request->name_ar);
        if ($request->notes) {
            $grade->notes = $request->notes;
        }
        $grade->save();

        return redirect()->route("grades.index")->with("success", "Grade has been saved successfully");
    }

    public function update(Request $request, Grade $grade)
    {
        $this->validate($request, [
            "name_ar" => "required",
            "name_en" => "required",
            "notes" => "sometimes",
        ]);

        $grade->setTranslation("name", "en", $request->name_en);
        $grade->setTranslation("name", "ar", $request->name_ar);
        if ($request->notes) {
            $grade->notes = $request->notes;
        }
        $grade->save();
        return redirect()->route("grades.index")->with("success", "Grade has been updated successfully");
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route("grades.index")->with("success", "Grade has been deleted successfully");
    }
}
