<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Group;
use App\Models\Role;
use App\Models\Event;
use Auth;

class ContentController extends Controller
{
    public function create(Request $request, $idgroup)
    {
    	$group = Group::find($idgroup);
    	$content = new Content();
    	$content->title = $request->content;
    	$content->level = $request->level;
    	$content->documents = "";
    	$content->content = $request->description;
    	$content->start_date = $request->start;
    	$content->end_date = $request->end;
    	$content->author = Auth::User()->id;
    	$content->group_id = $group->id;
        $status = Content::CONTENT_STATUS_DEACTIVE;

        if (Auth::user()->id == Group::find($idgroup)->author->id) {
            $status = Content::CONTENT_STATUS_ACTIVE;
        }
        $mentor = Role::where([['user_id',Auth::user()->id],['group_id',$idgroup]])->get();
        if (!$mentor->isEmpty()) {
            if ($mentor[0]->is_mentor) {
                $status = Content::CONTENT_STATUS_ACTIVE;
            }
        }

        $content->status = $status;
    	$content->save();

    	return redirect()->back()
    	->with(['message' => 'Add content successfully', 'alert' => 'alert-success']);
    }

    public function edit(Request $request, $idContent)
    {
        $content = Content::find($idContent);
        $content->title = $request->content;
        $content->content = $request->description;
        $content->level = $request->level;
        $content->start_date = $request->start;
        $content->end_date = $request->end;
        $content->save();

        return redirect()->back()
        ->with(['message' => 'Update content successfully', 'alert' => 'alert-success']);
    }

    public function delete($idContent)
    {
        Content::where('id',$idContent)->update(['status'=>Content::CONTENT_STATUS_HIDE]);

        return redirect()->back()
        ->with(['message' => 'Delete content successfully', 'alert' => 'alert-danger']);
    }

    public function detail($idContent)
    {
        $data['content'] = Content::find($idContent);
        return view('group.pages.content.detail', $data);
    }

    public function createEvent(Request $request, $idContent)
    {
        $content = Content::find($idContent);
        $event = new Event();
        $event->title = $request->event;
        $event->content = $request->description;
        $event->documents = $request->document;
        $event->start_date = $request->start_date;
        $event->author = $content->creator->id;
        $event->speaker = $request->speaker;
        $event->group_id = $content->group->id;
        $event->content_id = $content->id;
        $event->duration = $request->duration;
        $event->start_time = $request->start_time;
        $event->save();

        return redirect()->back()
        ->with(['message' => 'Add event for content successfully', 'alert' => 'alert-success']);
    }
}
