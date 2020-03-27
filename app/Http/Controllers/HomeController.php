<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public $course;

    public function __construct()
    {
        $this->courses = Course::orderBy('name','asc')->get();
    }

    public function index()
    {
        $courses = $this->courses;
        return view('pages.home', compact('courses'));
    }

    public function home()
    {
        $rolesFollowing = collect([]);
        $courses = $this->courses;
        $rolesCheck = Role::where([['user_id', Auth::user()->id], ['status', Role::ROLE_STATUS_ACTIVE]])->get();
            if (!$rolesCheck->isEmpty()) {
                $rolesFollowing = Role::where([
                    ['user_id', Auth::user()->id],
                    ['status', Role::ROLE_STATUS_ACTIVE]
                ])->with(['group:id,name'])->get();
            }
        return view('pages.home', compact('courses', 'rolesFollowing'));
    }
}
