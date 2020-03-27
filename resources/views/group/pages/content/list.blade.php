@push('css')
    <link rel="stylesheet" href="{{asset('source/css/listcontent.css')}}">
    <link rel="stylesheet" href="{{asset('source/css/detail-content.css')}}">
@endpush
<div class="tab-pane fade" id="pills-content" role="tabpanel" aria-labelledby="pills-content-tab">
    <div class="row">
        <div class="col-12">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">or view existing contents</a>
                    <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Add Content</a>
                </div>
            </nav>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <button type="button" class="btn btn-secondary btn-lg mt-4" data-toggle="modal" data-target="#myModel"
                    @if(Auth::user()->id != $caption->id  && !$viewPermission) {{'disabled'}}
                        @endif
                    >You have a new content ?</button>
                    <div class="modal fade" id="myModel">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Create New Content</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="/content/create/{{$group->id}}" method="POST" id="createContent">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Your Content Name</label>
                                            <input type="text" class="form-control" maxlength="64" name="content"
                                                   id="content">
                                        </div>
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select name="level" class="form-control">
                                                <option value="0">Beginner</option>
                                                <option value="1">Intermediate</option>
                                                <option value="2">Expert</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dateofbirth">Start Date</label>
                                            <input class="form-control" type="date" id="start" name="start">
                                        </div>
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input class="form-control" type="date" id="end" name="end">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Description</label>
                                            <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success mt-3 float-lg-right m-3">
                                            Done
                                        </button>
                                        <button type="submit" onclick="resetData()" class="btn btn-light mt-3 float-lg-right" data-dismiss="modal">
                                            <i class="fas fa-window-close"></i> Cancel
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"></div>
            </div>
        </div>
    </div>

    @foreach($contents as $content)
        <div class="row info">
            <div class="col-4 bg-image">
                <div class="row header-info">
                    <div class="col-5">
                        <h2>
                            @if(strtotime($content->end_date) > time())
                                {{'learning'}}
                            @else
                                {{"Done"}}
                            @endif
                        </h2>
                    </div>
                    <div class="col-7">
                        <i class="far fa-heart icon-heart"></i> <span> 0</span>
                    </div>
                </div>
                <div class="row main-info">
                    <div class="col-4">
                        <img src="source/img/user/{{$content->creator->avatar}}" class="avatar">
                    </div>
                    <div class="col-8" style="max-height: 340px;word-break: break-word;">
                        <p>{{$content->creator->name}}</p>
                        <ul>
                            <li>start: {{$content->start_date}}</li>
                            <li>End: {{$content->end_date}}</li>
                            <li>Tags: defaultTag</li>
                            <li>Level:
                                @if($content->level == 0)
                                    {{"Beginer"}}
                                @elseif($content->level == 1)
                                    {{'Intermediate'}}
                                @else
                                    {{'Expert'}}
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn btn-success takeattendance mt-3 ml-5" data-toggle="modal"
                        data-target=".bd-example-modal-lg" data-title="{{$content->title}}" data-id="{{$content->id}}"
                        data-attendance="{{($content->attendances)}}" data-memberatt="{{$members}}"
                @if(Auth::user()->id != $caption->id) {{'disabled'}} @endif

                @if(strtotime($content->end_date) <= time())
                    {{'disabled'}}
                    @endif
                >Take Attendance
                </button>

            </div>
            <div class="col-8 header-content">
                <div class="row">
                    <div class="col-md-10">
                           <p style="max-width: 100%;overflow: hidden;color: #005aff;font-size: 25px;font-weight: bold">
                                {{$content->title}}
                           </p>
                    </div>
                    <div class="col-md-2">
                        <div class="dropdown">
                            <a href="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                ...
                            </a>
                            @if(Auth::user()->id == $caption->id)
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" data-toggle="modal"
                                       @if(strtotime($content->end_date) > time())
                                       {! data-target="#createEvent{{$content->id}}" !}}
                                       {! href="{{route('content.create-event', $content->id)}}" !}
                                    @else{{"disabled"}}
                                        @endif
                                    >
                                        Create event for content
                                    </a>
                                    <a class="dropdown-item" href="/content/edit/{{$content->id}}" data-toggle="modal"
                                       data-target="#myModelEdit{{$content->id}}">Edit</a>
                                    <a onclick="return deleteContent('{{$content->title}}')" class="dropdown-item"
                                       href="/content/delete/{{$content->id}}">Delete</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-15" style="margin-left:7%;margin-left: 3%;width: 90%;height: auto;word-break: break-word;">

                            @if(strlen($content->content) <= 300)
                            {!! \Illuminate\Support\Str::limit($content->content, 300, $end='')  !!}
                            @else
                            {!! \Illuminate\Support\Str::limit($content->content, 300, $end='...') !!}
                                <div class="btn-view" style="margin-top: 95px;margin-left: 81%;" ><a style="color:blue;" href="/content/detail/{{$content->id}}">view all >></a>
                                </div>
                            @endif

                    </div>


                </div>
            </div>
        </div>
		<div class="modal fade" id="myModelEdit{{$content->id}}">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Edit Content</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form action="/content/edit/{{$content->id}}" method="post" id="editContent">
							@csrf
							<div class="form-group">
								<label for="name">Your Content Name</label>
								<input type="text" class="form-control" maxlength="64" name="content" id="content" value="{{$content->title}}">
							</div>
							<div class="form-group">
								<label>Level</label>
								<select name="level" class="form-control">
									<option @if ($content->level == 0) selected @endif value="0">Beginner</option>
									<option @if ($content->level == 1) selected @endif  value="1">Intermediate</option>
									<option @if ($content->level == 2) selected @endif  value="2">Expert</option>
								</select>
							</div>
							<div class="form-group">
								<label for="dateofbirth">Start Date</label>
								<input class="form-control" type="date" name="start" value="{{$content->start_date}}">
							</div>
							<div class="form-group">
								<label for="dateofbirth">End Date</label>
								<input class="form-control" type="date" name="end" value="{{$content->end_date}}">
							</div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Description</label>
								<textarea class="form-control" required rows="3" name="description" id="des{{$content->id}}">{{$content->content}}</textarea>
							</div>
							<button type="submit" class="btn btn-success mt-3 float-lg-right m-3" id="done">Done</button>
							<button type="submit" class="btn btn-light mt-3 float-lg-right" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancel</button>
						</form>
					</div>
				</div>
			</div>
		</div>

        <div class="modal fade" id="createEvent{{$content->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Event</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('content.create-event', $content->id)}}" method="POST" id="createEvent">
                            @csrf
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" class="form-control" maxlength="64" name="event" maxlength="64" placeholder="title">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="description" placeholder="something about your event" maxlength="255"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Document Link</label>
                                <input type="url" class="form-control" name="document" placeholder="Document Link">
                            </div>
                            <div class="form-group">
                                <label>Speaker</label>
                                <input type="text" class="form-control" maxlength="32" name="speaker">
                            </div>
                            <div class="form-group">
                                <label for="dateofbirth">Start Time</label>
                                <input class="form-control" type="date" name="start_date">
                            </div>
                            <div class="form-group">
                                <label>Start Time</label>
                                <input class="form-control" type="time" name="start_time">
                            </div>
                            <div class="form-group">
                                <label>Duration</label>
                                <select class="form-control" name="duration">
                                    <option value="2">2</option>
                                    <option value="4">4</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success mt-3 float-lg-right m-3">Done</button>
                            <input type="reset" value="Cancel" class="btn btn-secondary mt-3 float-lg-right">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 style="color: white;top: 9%; color: white;position: absolute;left: 34%;">Take
                            Attendance</h3>
                        <img src="{{asset('source/img/content/banner.jpeg')}}" class="img-fluid"
                             style="width: 100%;height: 250px"
                             alt="Responsive image">
                        <h5 class="modal-title mt-4" id="content-title" style="text-align: center">Modal title</h5>
                        <form id="takeattendance" method='POST'>
                            @CSRF
                            <input hidden value="" id="id-content">
                            @foreach($members as $key=>$member)     <!--member-->
                            <div class="row mt-5">
                                <div class="col-md-7">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{asset('source/img/user/'.$member->avatar)}}"
                                                 style="width: auto;height: 100px">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div>
                                                    <p style="color: #2009e1">{{$member->name}}</p>
                                                    <p>{{$member->email}}</p>
                                                    <div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                   id="member{{$member->id}}" name="member[]"
                                                                   value="{{$member->id}}">
                                                            <input type="hidden" name="member[]"
                                                                   value="{{$member->id}}"/>
                                                            <label class="custom-control-label"
                                                                   style="font-weight: bold"
                                                                   for="member{{$member->id}}">Present</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-5">
                                    <div class="row">
                                        <div>
                                            <input type="text" placeholder="Note"
                                                   style="width: 180%;"
                                                   name="note[]" id="note{{$member->id}}">
                                        </div>

                                    </div>

                                </div>
                            </div>

                            @endforeach
                        </form>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submit">Submits</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@push('scripts')
    <script>
        var urlAttendance = '{{config('constant.domain')}}/member/attendance/';
    </script>
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <script src="{{asset('source/js/group/content/ckeditor.js')}}"></script>
    <script src="{{asset('source/js/jquery/jquery.validate.min.js')}}"></script>
    <script src="{{asset('source/js/group/content/createValidate.js')}}"></script>
    <script src="{{asset('source/js/group/content/editValidate.js')}}"></script>
    <script src="{{asset('source/js/group/content/resetForm.js')}}"></script>
    <script src="{{asset('source/js/group/content/acceptDelete.js')}}"></script>
    <script src="{{asset('source/js/group/content/eventValidate.js')}}"></script>
    <script src="{{asset('source/js/group/content/takeattendance.js')}}"></script>
    <script type="text/javascript">
        @foreach($contents as $content)
        CKEDITOR.replace('des{{$content->id}}');
        @endforeach
    </script>
@endpush
