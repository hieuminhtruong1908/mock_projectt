<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\User;
use App\Models\Role;
use App\Models\Groups;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function list()
    {
        return view('group.pages.member.list');
    }

    public function fetch(Request $request)
    {
        $data['response'] = [];
        if ($request->get('query')) {
            $query = $request->get('query');
            $data['response'] = User::where('email', 'LIKE', '%' . $query . '%')->get();
        }

        return view('group.pages.member.search', $data)->render();
    }

    public function add($id)
    {
        $email = ltrim($_POST['member']);
        $user = User::where('email', $email)->get()->first();

        if (!$user) {
            return redirect()->route('group.detail', [$id, "#pills-member"])->with('error',
                'Email not exist in system');     //check khác dạng email công ty.
        }

        if (Auth::user()->id == $user->id && Auth::user()->id == Group::find($id)->author->id) {
            return redirect()->route('group.detail', [$id, "#pills-member"])->with('error',
                'You are caption in your group');    //check caption add yourself
        }

        $mentor = Role::where([
            ['user_id', $user->id],
            ['group_id', $id],
            ['status', Role::ROLE_STATUS_ACTIVE]
        ])->get();

        if (Auth::user()->id == $user->id && $mentor[0]->is_mentor) {                   //check mentor add yourself
            return redirect()->route('group.detail', [$id, "#pills-member"])->with('error',
                'You are mentor in your group');
        }

        $member = Role::where([
            ['user_id', $user->id],
            ['group_id', $id],
            ['status', Role::ROLE_STATUS_ACTIVE]
        ])->get();
        if (Auth::user()->id == $user->id && $member[0]->is_member) {            //check member add yourself
            return redirect()->route('group.detail', [$id, "#pills-member"])->with('error',
                'You are member in your group');
        }

        $role = Role::where([
            ['user_id', $user->id],
            ['group_id', $id],
            ['status', Role::ROLE_STATUS_ACTIVE]
        ])->get();

        if (!$role->isEmpty()) {            //check trùng member.

            return redirect()->route('group.detail', [$id, "#pills-member"])->with('error',
                'This member is already in the group');
        }

        $rolePending = Role::where([
            ['user_id', $user->id],
            ['group_id', $id],
            ['status', Role::ROLE_STATUS_DEACTIVE]
        ])->get();

        if (!$rolePending->isEmpty()) {
            return redirect()->route('group.detail', [$id, "#pills-member"])->with('error',
                'This person is waiting for approve');  //check pending
        }

        if ($user->id == Group::find($id)->author->id) {
            return redirect()->route('group.detail', [$id, "#pills-member"])->with('error',
                'This member is the captain of the group');   //Check add caption.
        }

        $status = Role::ROLE_STATUS_DEACTIVE;
        $role = new Role();
        $role->level = 1;
        $role->user_id = $user->id;
        $role->group_id = $id;
        if (Auth::user()->id == Group::find($id)->author->id) {
            $status = Role::ROLE_STATUS_ACTIVE;
        }
        $role->status = $status;
        $role->save();

        return redirect()->route('group.detail', [$id, "#pills-member"])->with('message', 'Add member success');
    }
}
