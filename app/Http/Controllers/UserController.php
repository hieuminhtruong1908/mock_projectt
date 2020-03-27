<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Role;
use App\Models\Group;

class UserController extends Controller
{
    //
    public function logout()
    {
        Auth::logout();
        return redirect()->route('index')->with(['message' => 'Logout thành công', 'alert' => 'alert-success']);
    }

    public function profile()
    {
        $rolesFollowing = collect([]);
        $rolesCheck = Role::where([['user_id', Auth::user()->id], ['status', Role::ROLE_STATUS_ACTIVE]])->get();
        if (!$rolesCheck->isEmpty()) {
            $rolesFollowing = Role::where([
                ['user_id', Auth::user()->id],
                ['status', Role::ROLE_STATUS_ACTIVE]
            ])->with(['group:id,name'])->get();
        }

        return view('profile.index', [
            'user' => Auth::user(),
            'rolesFollowing' => $rolesFollowing
        ]);
    }

    public function update($id, UpdateProfile $request)
    {
        $validation = $request->validated();

        if ($validation) {
            $user = User::find($id);
            $user->avatar = $this->storeImage($request, $user);
            if (!$user->avatar) {
                $user->avatar = "user_login.png";
            }
            $user->name = $request->name;
            $user->nickname = $request->skype;
            $user->date_of_birth = date('Y-m-d', strtotime($request->date));
            $user->info = $request->info;
            $user->save();

            return response()->json([
                'message' => 'Update Successfully',
                'class_name' => 'alert-success',
                'src_img' => $user->avatar
            ], 200);
        }

        return response()->json(['message' => $validation->errors()->first(), 'class_name' => 'alert-danger'],
            200); //error
    }

    public function storeImage(Request $request, $user)
    {
        if ($request->hasFile('file')) {
            unlink('source/img/user/' . $user->avatar);
            $avatar = $request->file('file');
            $avatarExtension = $avatar->getClientOriginalExtension();
            $nameImage = time() . str_replace(" ", "_", $user->name) . '.' . $avatarExtension;
            $avatar->move('source/img/user', $nameImage);
            return $nameImage;
        } else {
            if ($user->avatar) {

                return $user->avatar;
            }
        }
    }

    public function remove($idGroup, $idMember)
    {
        $role = Role::where([['group_id', $idGroup], ['user_id', $idMember]])->get();
        if ($role->isEmpty()) {
            abort(404);
        }

        if (Role::where([['group_id', $idGroup], ['user_id', $idMember]])->delete()) {
            $nameMember = User::find($idMember)->name;

            return redirect()->route('group.detail', [$idGroup, "#pills-member"])->with([
                "message" => "You have been removed $nameMember out in your group",
                "alert" => "alert-success"
            ]);
        }

        return redirect()->route('group.detail',
            [$idGroup, "#pills-member"])->withErrors('Have an error occurred!')->withInput();
    }

    public function setMentor($idGroup, $idMember)
    {
        $role = Role::where([['group_id', $idGroup], ['user_id', $idMember]])->get();

        if ($role->isEmpty()) {
            abort(404);
        }

        $nameMentor = User::find($idMember)->name;
        $roleCheckMentor = Role::where([['group_id', $idGroup], ['level', 2]])->get();

        if (!$roleCheckMentor->isEmpty()) {      //Đã có mentor trong group
            Role::where([['group_id', $idGroup], ['level', 2]])->update(['level' => 1]);
            Role::where([['group_id', $idGroup], ['user_id', $idMember]])->update(['level' => 2]);

            return redirect()->route('group.detail', [$idGroup, "#pills-member"])->with([
                "message" => "You have been set mentor for $nameMentor",
                "alert" => "alert-success"
            ]);;
        }
        Role::where([
            ['group_id', $idGroup],
            ['user_id', $idMember]
        ])->update(['level' => 2]); //Chưa có mentor thi set mentor

        return redirect()->route('group.detail', [$idGroup, "#pills-member"])->with([
            "message" => "You have been set mentor for $nameMentor",
            "alert" => "alert-success"
        ]);
    }

    public function setCaption($idGroup, $idMember)
    {
        $group = Group::find($idGroup);
        $role = Role::where([['group_id', $idGroup], ['user_id', $idMember]])->get();

        if ($role->isEmpty()) {
            abort(404);
        }
        if(Auth::user()->id != $group->author->id)
        {
            return redirect()->route('group.detail', [$idGroup, "#pills-member"])->with([
                "message" => "You not is caption in group",
                "alert" => "alert-success"
            ]);
        }

        $nameMember = User::find($idMember)->name;
        Role::where([['group_id', $idGroup], ['user_id', $idMember]])->delete();   //Xóa role member
        $group = Group::find($idGroup);

        $roleNew = new Role();
        $roleNew->level = 1;
        $roleNew->user_id = $group->creator;
        $roleNew->group_id = $idGroup;
        $roleNew->status = Role::ROLE_STATUS_ACTIVE; //active member.
        $roleNew->save();     //Set member cho caption cũ

        $group->creator = $idMember;    //Set caption mới.
        $group->save();

        return redirect()->route('group.detail', [$idGroup, "#pills-member"])->with([
            "message" => "You have been set caption for $nameMember",
            "alert" => "alert-success"
        ]);
    }

    public function removeMentor($idGroup, $idMentor)
    {
        $role = Role::where([["group_id", $idGroup], ["user_id", $idMentor]])->get();
        if ($role->isEmpty()) {
            abort(404);
        }
        $nameMentor = User::find($idMentor)->name;
        Role::where([["group_id", $idGroup], ["user_id", $idMentor]])->update([    //set member for mentor
            "level" => 1
        ]);

        return redirect()->route('group.detail', [$idGroup, "#pills-member"])->with([
            "message" => "You have been remove mentor of $nameMentor",
            "alert" => "alert-success"
        ]);;
    }

    public function getInfor($idGroup, $id)
    {
        if (Auth::user()->id != $id) {
            abort(404);
        }

        $roleCheck = Role::where([
            ['group_id', $idGroup],
            ['user_id', $id],
            ['status', Role::ROLE_STATUS_DEACTIVE]
        ])->get();
        if ($roleCheck->isEmpty()) {
            $role = new Role();
            $role->level = 1;
            $role->group_id = $idGroup;
            $role->user_id = $id;
            $role->status = Role::ROLE_STATUS_DEACTIVE;
            $role->save();
        }

        return redirect()->route('group.detail', [$idGroup]);
    }

    public function approve($idGroup, $id)
    {
        Role::where([
            ['group_id', $idGroup],
            ['user_id', $id],
            ['status', Role::ROLE_STATUS_DEACTIVE]
        ])->update(['status' => Role::ROLE_STATUS_ACTIVE]);
        return redirect()->route('group.detail', [$idGroup, "#pills-pendingItem","#memberPending"]);
    }

    public function decline($idGroup, $id)
    {
        Role::where([['group_id', $idGroup], ['user_id', $id], ['status', Role::ROLE_STATUS_DEACTIVE]])->delete();
        return redirect()->route('group.detail', [$idGroup, "#pills-pendingItem","#memberPending"]);
    }

    public function acceptLeave($idGroup, $idMember)
    {
        $role = Role::where([['group_id', $idGroup], ['user_id', $idMember]])->get();
        if (!$role->isEmpty()) {
            Role::where([['group_id', $idGroup], ['user_id', $idMember]])->delete();
        }

        return response('message', 200);
    }
}
