<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCourse;
use Auth;
use App\Models\Course;
use App\Http\Requests\AddCourseRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CourseController extends Controller
{
    public function list()
    {
        return view('course.list');
    }

    public function create(AddCourseRequest $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        try {
            $data = new Course;
            $data->name = $request->course;
            $data->description = $request->description;
            $data->user_id = Auth::user()->id;
            $data->save();
        }catch (\PDOException $exception){

            return redirect()->back()->withErrors('Have an error occurred!')->withInput();
        }

        return redirect()->back()->with(["message"=>"Add course successfully","alert" => "alert-success"]);
    }

    public function edit(EditCourse $request, $id)
    {
        $validation = $request->validated();
        if ($validation){
            $course = Course::where([
                ['id', '<>', $id],
                ['name', $request->name]
            ])->get()->first();

            if ($course){

                return response()->json(['exist' => "Course is exists"], 200);
            }
            try{
                $course = Course::findOrFail($id);
                $course->name = $request->name;
                $course->description = $request->desciption;
                $course->save();

                return response()->json(['message' => "Edit  successfully"], 200);

            } catch (\ModelNotFoundException  $e){

                return redirect()->back()->withErrors("Have an error occurred!")->withInput();
            }
        }

        return response()->json(['message' => $validation->errors()->first()], 200);
    }
}
