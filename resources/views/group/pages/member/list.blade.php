<div class="tab-pane fade" id="pills-member" role="tabpanel" aria-labelledby="pills-member-tab">

    {{-- Member--}}
    <div class="row" style="margin-top: 20px">

        <div class="col-md-6 " style="margin-top: 10px">         <!--caption-->
            @if($viewPermission || Auth::user()->id == $caption->id)
                <a href="#" class="" data-toggle="modal" data-target="#exampleModal"
                   data-name="{{$caption->name}}" data-email="{{$caption->email}}"
                   data-start_date="{{$group->start_date}}" data-nickname="{{$caption->nickname}}"
                   data-avatar="{{$caption->avatar}}"
                   data-namegroup="
                  @foreach($caption->roles as $role)
                   @if($role->status == \App\Models\Role::ROLE_STATUS_DEACTIVE)
                   @continue
                   @endif
                   {{$role->group->name . " ; "}}
                   @endforeach{{$groupJoined}}"
                   data-info="&emsp;&emsp;{{$caption->info}}"
                   id="caption"
                   data-id>
                    @endif
                    <div class="row">
                        <div class="col-md-5" style="height: 220px">

                            <img style="width: 100%;height: 100%" src='{{asset("source/img/user/$caption->avatar")}}'>

                        </div>
                        <div class="col-md-7 border" style="height: 220px">
                            <div>
                                <p style="color: #ff6119;">{{$caption->name}} <i class="fa fa-star"></i></p>
                                <p>Joined date :{{$group->start_date}} </p>
                            </div>
                            <div style="height: 78px">
                                <p>Gmail: {{$caption->email}}</p>
                                <p>Skype: {{$caption->nickname}}</p>
                            </div>
                        </div>
                    </div>
                    @if($viewPermission || Auth::user()->id == $caption->id)
                </a>
            @endif
        </div>

        @foreach($roles as $role)
            @if($role->is_mentor)
                <div class="col-md-6" style="margin-top: 10px; position: relative">         <!--mentor-->

                    @if($viewPermission || Auth::user()->id == $caption->id)
                        <a href="#" class="" data-toggle="modal" data-target="#exampleModal"
                           data-name="{{$role->user->name}}" data-email="{{$role->user->email}}"
                           data-start_date="{{$role->created_at->format('Y-d-m')}}" data-nickname="{{$role->user->nickname}}"
                           data-avatar="{{$role->user->avatar}}"
                           data-info="&emsp;&emsp;{{$role->user->info}}"
                           data-namegroup="
                           @foreach($role->user->roles as $role)
                           @if($role->status == \App\Models\Role::ROLE_STATUS_DEACTIVE)
                           @continue
                           @endif
                           {{$role->group->name  ." ; "}}
                           @endforeach
                               " id="mentor">
                            @endif
                            <div class="row ">
                                <div class="col-md-5" style="height: 220px">

                                    <img style="width: 100%;height: 100%"
                                         src="{{asset('source/img/user/'.$role->user->avatar)}}">

                                </div>
                                <div class="col-md-7 border" style="height: 220px">
                                    <div class="row">

                                        <div class="col-md-10">
                                            <div>
                                                <p style="color: #ff6119;">{{$role->user->name}} <i style="margin-top:2%"
                                                                                     class="fa fa-user"></i></p>
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
                            @if($viewPermission || Auth::user()->id == $caption->id)
                        </a>
                    @endif
                    <div class="col-md-2 " style="position: absolute; top: 0px; right: 0px">
                        @if(Auth::user()->id == $caption->id)
                            <div>
                                <div class="dropdown" style="position: absolute;right: 4px; top: -6px;">
                                    <a type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        ...
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item"
                                           href="{{route('member.remove',[$group->id,$role->user->id])}}">Remove</a>
                                        <a class="dropdown-item"
                                           href="{{route('member.removeMentor',[$group->id,$role->user->id])}}">Remove
                                            mentor</a>
                                        <a class="dropdown-item"
                                           href="{{route('member.setCaption',[$group->id,$role->user->id])}}">Set
                                            caption</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>  <!--//mentor-->
                @break
            @endif
        @endforeach



        @foreach($memberSorts as $key=>$member)     <!--member-->
        @if($roles[$key]->is_mentor)
            @continue
        @endif
        <div class="col-md-6 " style="margin-top: 10px;position: relative">
            @if($viewPermission || Auth::user()->id == $caption->id)
                <a href="#" class="member" data-toggle="modal" data-target="#exampleModal" data-id="2"
                   data-name="{{$member->name}}" data-email="{{$member->email}}"
                   data-start_date="{{$role->created_at->format('Y-d-m')}}" data-nickname="{{$member->nickname}}"
                   data-avatar="{{$member->avatar}}"
                   data-namegroup="
                   @foreach($member->roles as $role)
                   @if($role->status == \App\Models\Role::ROLE_STATUS_DEACTIVE)
                   @continue
                   @endif
                   {{$role->group->name  ." ; "}}
                   @endforeach"
                   data-info="&emsp;&emsp;{{$member->info}}">
                    @endif


                    <div class="row">
                        <div class="col-md-5" style="height: 220px">
                            <img style="width: 100%;height: 100%"
                                 src='{{asset("source/img/user/$member->avatar")}}'>
                        </div>
                        <div class="col-md-7 border" style="height: 220px">
                            <div class="row" style="height: 220px">
                                <div class="col-md-10">
                                    <div>
                                        <p>{{$member->name}}</p>
                                        <p>Joined date :{{$roles[$key]->created_at->format('Y-d-m')}} </p>
                                    </div>
                                    <div>
                                        <p>Gmail: {{$member->email}}</p>
                                        <p>Skype: {{$member->nickname}}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="position: absolute;top:0;right: 0">

                        @if(Auth::user()->id == $caption->id)
                            <div>
                                <div class="dropdown" style="position: absolute;right: 4px; top: -6px;">
                                    <a type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        ...
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item"
                                           href="{{route('member.remove',[$group->id,$member->id])}}">Remove</a>
                                        <a class="dropdown-item"
                                           href="{{route('member.setCaption',[$group->id,$member->id])}}">Set
                                            Caption</a>
                                        <a class="dropdown-item"
                                           href="{{route('member.setMentor',[$group->id,$member->id])}}">Set
                                            mentor</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($viewPermission || Auth::user()->id == $caption->id)
                </a>
            @endif
        </div>

        @endforeach
    </div>
</div>
{{--         Modal detail--}}
<div style="width: 100%" class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content form-modal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">

                    <div class="row" style="margin-top: 50px">
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <div style="height: 50%">
                                <img class="size-img" id="avatarcaption" src="">
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-7">
                            <div>
                                <h2 id="name">
                                </h2>
                                <table style="width: 100%">
                                    <tr class="border-bottom top40">
                                        <td><b>Joined date</b></td>
                                        <td id="joindate"></td>
                                    </tr>
                                    <tr class="border-bottom top40">
                                        <td><b>Gmail</b></td>
                                        <td id="email"></td>
                                    </tr>
                                    <tr class="border-bottom top40">
                                        <td><b>Skype</b></td>
                                        <td id="nickname"></td>
                                    </tr>
                                    <tr class="border-bottom top40">
                                        <td><b>Group Joined:</b></td>
                                        <td>

                                            <p style="margin-top: 14px;" id="groupjoined"></p>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Introduce yourself</b></td>
                                    </tr>

                                </table>
                                <div style="margin-top: 20px">
                                    <textarea style="width: 100%;border: none;background-color: white" disabled name=""
                                              id="info" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
{{--         End modal--}}
@push('scripts')
    <script src="{{asset('source/js/member-detail/detail.js')}}"></script>
@endpush
