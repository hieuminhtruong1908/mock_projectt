<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadAvatar;
use App\Http\Requests\UploadCover;
use App\Models\Attendance;
use App\Models\Content;
use App\Models\Role;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\CreateGroupRequest;
use App\Models\Group;
use App\Models\Course;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Event;

class GroupController extends Controller
{
    public function list($idCourse)
    {
        try {
            $course = Course::findOrFail($idCourse);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        $data['course'] = Course::find($idCourse);
        $data['coming'] = Group::where([
            ['course_id', $idCourse],
            ['start_date', '>', $time->ToDateTimeString()],
        ])
            ->orderBy('start_date', 'desc')
            ->orderBy('name', 'asc')
            ->get();

        $data['running'] = Group::where([
            ['course_id', $idCourse],
            ['start_date', '<', $time->ToDateTimeString()],
        ])
            ->orderBy('start_date', 'desc')
            ->orderBy('name', 'asc')
            ->get();

        $rolesFollowing = collect([]);
        $rolesCheck = Role::where([['user_id', Auth::user()->id], ['status', Role::ROLE_STATUS_ACTIVE]])->get();
        if (!$rolesCheck->isEmpty()) {
            $rolesFollowing = Role::where([
                ['user_id', Auth::user()->id],
                ['status', Role::ROLE_STATUS_ACTIVE]
            ])->with(['group:id,name'])->get();
        }

        return view('group.list', $data, compact('rolesFollowing'));
    }

    public function create(CreateGroupRequest $request, $idCourse)
    {
        $course = Course::find($idCourse);
        $group = new Group();
        $group->name = $request->group;
        $group->description = $request->description;
        $group->start_date = $request->start;
        $group->creator = Auth::user()->id;
        $group->course_id = $course->id;
        $group->slug = Auth::user()->avatar; //avatar mặc định của group
        $avatar = file_get_contents('source/img/user/' . Auth::user()->avatar);
        file_put_contents('source/img/group/' . Auth::user()->avatar, $avatar);
        $group->thumbnail = "banner.jpg"; //cover mặc định
        $group->save();

        return redirect()->back()->with([
            'message' => 'Add group successfully',
            "alert" => "alert-success"
        ]);  //fix show message
    }

    public function home($id)
    {
        try {
            $group = Group::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return view('errors.404');
        }

        $contents = Content::where([['group_id', $id],['status',Content::CONTENT_STATUS_ACTIVE]])
        ->orderBy('end_date', 'desc')
        ->orderBy('start_date', 'desc')
        ->get();

        $caption = Group::find($id)->author;
        $groupJoined = "";
        foreach ($caption->groups as $group){
            $groupJoined.=$group->name . ";";
        }
        $group = Group::find($id);

        $roles = Role::where([['group_id', $id], ['status', Role::ROLE_STATUS_ACTIVE]])->with(['user'])->get();
        $member = [];

        $viewPermission = false;
        $waitting = false;

        $rolesWatting = Role::where([
            ['group_id', $id],
            ['status', Role::ROLE_STATUS_DEACTIVE],
            ['user_id', Auth::user()->id]
        ])->get();

        if (!$rolesWatting->isEmpty()) {
            $waitting = true;   //Khi click want to learn chuyển trạng thái thánh watiting
        }


        foreach ($roles as $values) {
            $member[] = User::find($values->user->id);
            if (Auth::user()->id == $values->user->id) {
                $viewPermission = true;   //Member được view detail
            }
        }

        $memberSorts = collect($member)->sortBy('name')->values()->all();
        $members = collect($member);


        $rolePendingMember = Role::where([
            ['group_id', $id],
            ['status', Role::ROLE_STATUS_DEACTIVE]
        ])->with(['user'])->get();
        $contentPending = Content::where([['group_id', $id], ['status', Content::CONTENT_STATUS_DEACTIVE]])->get();

        $rolesFollowing = collect([]);
        $rolesCheck = Role::where([['user_id', Auth::user()->id], ['status', Role::ROLE_STATUS_ACTIVE]])->get();
        if (!$rolesCheck->isEmpty()) {
            $rolesFollowing = Role::where([
                ['user_id', Auth::user()->id],
                ['status', Role::ROLE_STATUS_ACTIVE]
            ])->with(['group:id,name'])->get();
        }
        $events = Event::where('group_id', $id)->get();

        $attendanceContents = Attendance::with(['content','user'])->get()->groupBy('content_id')->values();

        return view('group.layout-detail',
            compact('group', 'caption', 'roles', 'contents', 'memberSorts', 'viewPermission', 'waitting',
                'rolePendingMember', 'contentPending', 'rolesFollowing', 'members','attendanceContents','groupJoined','events'));
    }

    public function uploadAvatar(UploadAvatar $request, $id)
    {
        $validate = $request->validated();
        if ($validate) {
            $group = Group::find($id);

            $image = $request->file('upload');
            $nameImage = time() . '.' . $image->getClientOriginalExtension();
            if ($group->slug) {
                unlink('source/img/group/' . $group->slug);
            }

            $image->move('source/img/group', $nameImage);
            $group->slug = $nameImage;
            $group->save();

            return response()->json([
                'message' => "Upload successfully",
                'class_name' => 'alert-success'
            ]);
        }

        return response()->json([
            'message' => "test",
            'class_name' => 'alert-danger'
        ]);
    }

    public function uploadCover(UploadCover $request, $id)
    {
        $validate = $request->validated();
        if ($validate) {
            $group = Group::findOrFail($id);

            $image = $request->file('uploadCover');
            $nameImage = time() . '.' . $image->getClientOriginalExtension();

            if ($group->thumbnail) {
                unlink('source/img/group/' . $group->thumbnail);
            }

            $image->move('source/img/group', $nameImage);
            $group->thumbnail = $nameImage;
            $group->save();

            return response()->json([
                'message' => "Upload Cover successfully",
                'class_name' => 'alert-success'
            ]);
        }

        return response()->json([
            'message' => $validate->error()->first(),
            'class_name' => 'alert-danger'
        ]);
    }
    public function approve($idGroup, $idContent)
    {
        $content = Content::find($idContent);
        $content->status = 1;
        $content->save();
        return redirect()->route('group.detail', [$idGroup, "#pills-pendingItem","#contentPending"]);
    }
    public function decline($idGroup, $idContent)
    {
        $content = Content::find($idContent);
        $content->delete();
        return redirect()->route('group.detail', [$idGroup, "#pills-pendingItem","#contentPending"]);
    }

    public function changeName($id, Request $request)
    {
        $group = Group::where([['id', '<>', $id], ['name', $request->name]])->get();
        if (!$group->isEmpty()) {
            return redirect()->route('group.detail', [$id, "#pills-setting"])->with([
                'error' => "Group Name is exists",
                "alert" => "alert-danger"
            ]);
        }
        Group::where('id', $id)->update(['name' => $request->name]);

        return redirect()->route('group.detail', $id)->with([
            'message' => "Change Name Successfully",
            "alert" => "alert-success"
        ]);
    }

    public function changeDes($id, Request $request)
    {
        Group::where('id', $id)->update(['description' => $request->descr]);

        return redirect()->route('group.detail', $id)->with([
            'message' => "Change Description Successfully",
            "alert" => "alert-success"
        ]);
    }

    public function changeAvatar($id, Request $request)
    {
        unlink('source/img/group/' . Group::find($id)->slug);
        $file = $request->file('avatar');
        $slug = time() . '.' . $file->getClientOriginalName();
        Group::where('id', $id)->update(['slug' => $slug]);
        $file->move('source/img/group/', $slug);

        return redirect()->route('group.detail', $id)->with([
            'message' => "Upload Avatar Successfully",
            'alert' => "alert-success"
        ]);
    }

    public function changeCover($id, Request $request)
    {
        unlink('source/img/group/' . Group::find($id)->thumbnail);
        $file = $request->file('changecover');
        $thumbnail = time() . '.' . $file->getClientOriginalName();
        Group::where('id', $id)->update(['thumbnail' => $thumbnail]);
        $file->move('source/img/group/', $thumbnail);

        return redirect()->route('group.detail', $id)->with([
            'message' => "Upload Cover Successfully",
            'alert' => "alert-success"
        ]);
    }
}
