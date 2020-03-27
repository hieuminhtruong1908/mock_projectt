<div class="tab-pane fade" id="pills-pendingItem" role="tabpanel"
     aria-labelledby="pills-pendingItem-tab">
    <ul class="nav nav-tabs" id="myTabPending" role="tablist">
        <li class="nav-item" style="position: relative">

            <a class="nav-link " id="memberPending-tab" data-toggle="tab" href="#memberPending" role="tab"
               aria-controls="memberPending" aria-selected="true">Member Pending

            </a>
            @if(Auth::user()->id == $caption->id)

                @if(!$rolePendingMember->isEmpty())
                    <input class="rounded-circle pending1" disabled
                           {! value="{{count($rolePendingMember)}}" !}
                    />
                @else
                    {{""}}
                @endif
            @endif

        </li>
        <li class="nav-item" style="position: relative">
            <a class="nav-link" id="contentPending-tab" data-toggle="tab" href="#contentPending" role="tab"
               aria-controls="contentPending" aria-selected="false">Content Pending</a>
            @if(Auth::user()->id == $caption->id)

                @if(!$contentPending->isEmpty())
                    <input class="rounded-circle pending2" disabled
                           {! value="{{count($contentPending)}}" !}
                    />
                @else
                    {{""}}
                @endif
            @endif
        </li>

    </ul>
    <div class="tab-content" id="myTabContentPending">
        <div class="tab-pane fade" id="memberPending" role="tabpanel" aria-labelledby="memberPending-tab">
            <div class="row" style="margin-top: 20px">
                @if(!$rolePendingMember->isEmpty())
                    @foreach($rolePendingMember as $role)
                        <div class="col-md-12 " style="margin-top: 20px;position: relative">
                            <div class="row" style="margin-top: 20px">
                                <div class="col-md-5" style="height: 220px">
                                    <img style="width: 100%;height: 100%"
                                         src="{{asset('source/img/user/'.$role->user->avatar)}}">
                                </div>
                                <div class="col-md-7 border" style="height: 220px">
                                    <div class="row" style="height: 220px">
                                        <div class="col-md-10">
                                            <div>
                                                <p>{{$role->user->name}}</p>
                                                <p>Joined date :{{$role->created_at->format('Y-d-m')}} </p>
                                            </div>
                                            <div>
                                                <p>Gmail: {{$role->user->email}}</p>
                                                <p>Skype: {{$role->user->nickname}}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 5%;margin-left: 61% ">

                                @if(Auth::user()->id == $caption->id)
                                    <a style="margin-right: 5% "
                                       href="{{route('member.approve',[$group->id,$role->user->id])}}" !}

                                    >
                                        <button class="btn btn-primary">Approve</button>
                                    </a>
                                    <a href="{{route('member.decline',[$group->id,$role->user->id])}}">
                                        <button class="btn btn-danger">Decline</button>
                                    </a>
                                @endif

                            </div>
                        </div>

                    @endforeach
                @endif
            </div>


        </div>
        <div class="tab-pane fade" id="contentPending" role="tabpanel" aria-labelledby="contentPending-tab">
            @if(!$contentPending->isEmpty())
                @foreach($contentPending as $content)
                    <div class="row info">
                        <div class="col-4 bg-image">
                            <div class="row header-info">
                                <div class="col-5">
                                </div>
                                <div class="col-7">
                                    <i class="far fa-heart icon-heart"></i> <span> 0</span>
                                </div>
                            </div>
                            <div class="row main-info">
                                <div class="col-4">
                                    <img src="source/img/user/{{$content->creator->avatar}}" class="avatar">
                                </div>
                                <div class="col-8">
                                    <p>{{$content->creator->name}}</p>
                                    <ul>
                                        <li>Start: {{$content->start_date}}</li>
                                        <li>End: {{$content->end_date}}</li>
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
                        </div>
                        <div class="col-8 header-content">
                            <div class="row" style="height: 89%">
                               <h3 class="ml-5" style="word-wrap: break-word;width: 100%;overflow: auto;max-height: 100px">{{$content->title}}</h3>
                                <div class="description-content"
                                     style="word-wrap: break-word;overflow: auto;width: 100%;margin-left: 18px;">
                                    @if(strlen($content->content)<=300)  {!!  $content->content !!}

                                    @else
                                        {!!   substr($content->content,0,303)   !!} ...<br/>
                                        <a href="#" style="color: blue;float: right" type="button" data-toggle="modal"
                                           data-target="#viewAll"
                                           data-title="{{$content->title}}" data-author="{{$content->creator->name}}"
                                           data-level="{{$content->level}}"
                                           data-start="{{$content->start_date}}" data-end="{{$content->end_date}}"
                                           data-des="{{$content->content}}" class="viewAll"
                                        >... View All</a>
                                    @endif
                                </div>
                            </div>

                            <div class="row" style="margin-left: 5%">

                                @if(Auth::user()->id == $caption->id)
                                    <a style="margin-right: 5% "
                                       href="{{route('content.approve',[$group->id,$content->id])}}" !}>
                                        <button class="btn btn-primary">Approve</button>
                                    </a>
                                    <a href="{{route('content.decline',[$group->id,$content->id])}}">
                                        <button class="btn btn-danger">Decline</button>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>

                @endforeach
            @endif
            <div class="modal fade" id="viewAll">
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
                                <input type="text" class="form-control" id="pendingAuthor" style="background: white"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Titile</label>
                                <input type="text" class="form-control" id="pendingTitle" style="background: white"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <input type="text" class="form-control" id="pendingLevel" style="background: white"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label for="dateofbirth">Start Date</label>
                                <input class="form-control" type="date" style="background: white" id="pendingStart"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label for="dateofbirth">End Date</label>
                                <input class="form-control" type="date" style="background: white" id="pendingEnd"
                                       disabled>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" rows="3" name="viewall" id="viewall" disabled></textarea>
                            </div>

                            <button type="submit" class="btn btn-light mt-3 float-lg-right" data-dismiss="modal">
                                <i class="fas fa-window-close"></i> Close
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        CKEDITOR.replace('viewall');
    </script>
@endpush

