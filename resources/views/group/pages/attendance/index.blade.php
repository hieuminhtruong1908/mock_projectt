
<div class="tab-pane fade" id="pills-attendance" role="tabpanel"
     aria-labelledby="pills-attendance-tab">
    <h3 style="">List Content Attendance</h3>
    <div class="container">
            @if(!$attendanceContents->isEmpty())
                @foreach($attendanceContents as $attendanceContent)
                        @if($attendanceContent['0']->content->group_id == $group->id)
                        <div class="row info">

                            <div class="col-4 bg-image">
                                <a href="#" data-toggle="modal"
                                   data-target="#contentAtten" data-title="{{$attendanceContent['0']->content->title}}" data-id="{{$attendanceContent['0']->content->id}}"
                                   data-attendance="{{($attendanceContent['0']->content->attendances)}}" data-memberatt="{{$members}}" class="content-att">
                                <div class="row header-info">
                                    <div class="col-5">
                                        <h2>
                                            @if(strtotime($attendanceContent[0]->content->end_date) > time())
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
                                        <img src="source/img/user/{{$attendanceContent[0]->content->creator->avatar}}"
                                             class="avatar">
                                    </div>
                                    <div class="col-8">
                                        <p>{{$attendanceContent[0]->content->creator->name}}</p>
                                        <ul>
                                            <li>start: {{$attendanceContent[0]->content->start_date}}</li>
                                            <li>End: {{$attendanceContent[0]->content->end_date}}</li>
                                            <li>Tags: defaultTag</li>
                                            <li>Level:
                                                @if($attendanceContent[0]->content->level == 0)
                                                    {{"Beginer"}}
                                                @elseif($attendanceContent[0]->content->level == 1)
                                                    {{'Intermediate'}}
                                                @else
                                                    {{'Expert'}}
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                </a>

                            </div>

                            <div class="col-8 header-content">
                                <div class="row">
                                    <div class="row" style="height: 89%">
                                        <h3 class="ml-5" style="width: 487px;overflow: hidden;">{{$attendanceContent[0]->content->title}}</h3>
                                        <div class="description-content" style="margin-left:7%;margin-left: 7%;width: 100%;height: auto;word-break: break-word;">
                                          @if(strlen($attendanceContent[0]->content->content)>300)
                                              {!!   substr($attendanceContent[0]->content->content,0,300)   !!} ...<br/>
                                               <a href="#" style="color: blue;float: right" type="button" data-toggle="modal"
                                                  data-target="#contentAttendance" class="contentAttendance"
                                                 data-title="{{$attendanceContent[0]->content->title}}" data-author="{{$attendanceContent[0]->content->creator->name}}"
                                                 data-level="{{$attendanceContent[0]->content->level}}"--}}
                                                 data-start="{{$attendanceContent[0]->content->start_date}}" data-end="{{$attendanceContent[0]->content->end_date}}"
                                                  data-des="{{$attendanceContent[0]->content->content}}" class="viewAll"
                                               >... View All
                                              </a>
                                              @else
                                                {!! $attendanceContent[0]->content->content !!}
                                           @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                @endforeach
            @endif
                <div class="modal fade" id="contentAttendance">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Author</label>
                                    <input type="text" class="form-control" id="contentAuthor" style="background: white"
                                           disabled>
                                </div>
                                <div class="form-group">
                                    <label for="name">Titile</label>
                                    <input type="text" class="form-control" id="contentTitle" style="background: white"
                                           disabled>
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <input type="text" class="form-control" id="contentLevel" style="background: white"
                                           disabled>
                                </div>
                                <div class="form-group">
                                    <label for="dateofbirth">Start Date</label>
                                    <input class="form-control" type="date" style="background: white" id="contentStart"
                                           disabled>
                                </div>
                                <div class="form-group">
                                    <label for="dateofbirth">End Date</label>
                                    <input class="form-control" type="date" style="background: white" id="contentEnd"
                                           disabled>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" rows="3" name="contentAtt" id="contentAtt" disabled></textarea>
                                </div>

                                <button type="submit" class="btn btn-light mt-3 float-lg-right" data-dismiss="modal">
                                    <i class="fas fa-window-close"></i> Close
                                </button>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade bd-example-modal" id="contentAtten" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
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
                                    <h5 class="modal-title mt-4" id="content-title-att" style="text-align: center;overflow:hidden">Modal title</h5>
                                    <form>
                                        @CSRF
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
                                                                               id="member-{{$member->id}}"
                                                                               value="{{$member->id}}" disabled>
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
                                                               id="note-{{$member->id}}" disabled>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        @endforeach
                                    </form>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>
@push('scripts')
    <script>
        CKEDITOR.replace('contentAtt');
    </script>
    <script src="{{asset('source/js/group/content/listattendance.js')}}"></script>
@endpush
