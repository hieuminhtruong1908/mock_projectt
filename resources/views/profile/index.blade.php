@extends('layouts.index')
@push('css')
    <link rel="stylesheet" href="source/css/profile.css">
    <link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@endpush
@section('content')
    @include('layouts.header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab"
                                           href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">
                                            Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab"
                                           href="#connectedServices" role="tab" aria-controls="connectedServices"
                                           aria-selected="false">Update Profile</a>
                                    </li>
                                    <li id="flashMessage" style="margin-left: 5px">
                                        <div id="message" style="display: none" class="alert"></div>
                                    </li>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                         aria-labelledby="basicInfo-tab">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label class="fieldText"> Avatar</label><span
                                                    class="spanspan"></span><i class="fa fa-file-image-o"></i>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <img src="source/img/user/{{$user->avatar}}" id="imgProfile"
                                                     class="img-thumbnail"/>
                                            </div>
                                        </div>
                                        <hr/>


                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label class="fieldText"> Name</label><span
                                                    class="spanspan"></span><i class="fa fa-user"></i>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$user->name}}
                                            </div>
                                        </div>
                                        <hr/>

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label class="fieldText">Birth Date</label><span
                                                    class="spanspan"></span><i class="fa fa-birthday-cake"></i>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{date("m-d-Y",strtotime($user->date_of_birth))}}
                                            </div>
                                        </div>
                                        <hr/>


                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label class="fieldText">Skype</label><span
                                                    class="spanspan"></span><i class="fa fa-skype"></i>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$user->nickname}}
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label class="fieldText">Email</label><span
                                                    class="spanspan"></span><i class="fa fa-envelope-o"></i>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$user->email}}
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label class="fieldText">Ngày tham gia</label>
                                            </div>
                                            <div class="col-md-8 col-6">

                                                {{ $user->created_at->format('m-d-Y')}}

                                            </div>
                                        </div>
                                        <hr/>

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label class="fieldText">Giới thiệu bản thân</label><i style="margin-left: 5%;"
                                                    class="fa fa-address-book"></i>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                    <textarea rows="5"
                                                              style="width: 100%;background-color: white;border: none"
                                                              disabled>{{$user->info}}</textarea>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label class="fieldText">Các khóa học đã
                                                    tham gia</label><i id="khoahoc"
                                                                       class="fa fa-book"></i>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                @if(isset($rolesFollowing) && !$rolesFollowing->isEmpty())
                                                    @foreach($rolesFollowing as $role)
                                                        <span>{{$role->group->name}}</span> &ensp; {{','}}
                                                    @endforeach
                                                @endif
                                                @if(isset(Auth::user()->groups))
                                                    @foreach(Auth::user()->groups as $group)
                                                            <span>{{$group->name}}</span> &ensp; {{','}}
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <hr/>

                                    </div>
                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel"
                                         aria-labelledby="ConnectedServices-tab">
                                        <form method="POST" enctype="multipart/form-data"
                                              id="update-profile" action="{{route('profile.upload',$user->id)}}">
                                            @CSRF
                                            <input hidden id="user" value="{{$user->id}}">
                                            <div class="row" style="">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label class="fieldText"> Avatar</label><span
                                                        class="spanspan"></span><i class="fa fa-file-image-o"></i>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <img src="source/img/user/{{$user->avatar}}" id="profile-img-tag"
                                                         class="img-thumbnail"/>

                                                </div>


                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label class="fieldText"> Change Avatar</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                <span>
                                                    <input type="file" name="file" id="profile-img" accept="image/*">
                                                    <span id="file-error"></span>
                                                </span>

                                                </div>


                                            </div>
                                            <hr/>


                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label class="fieldText"> Name</label><span
                                                        class="spanspan"></span><i class="fa fa-user"></i>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <div class="row">
                                                        <div class="col-md-6"><input type="text" name="name"
                                                                                     value="{{$user->name}}"
                                                                                     class="nameStyle">
                                                        </div>
                                                        <div class="col-md-5"><span class="hide" id="name-error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label class="fieldText">Birth Date</label><span
                                                        class="spanspan"></span><i class="fa fa-birthday-cake"></i>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <div class="row">
                                                        <div class="col-md-6"><input type="date" name="date" value="{{$user->date_of_birth}}"
                                                            style="border: none;background: white;">
                                                        </div>
                                                        <div class="col-md-6"><span class="hide" id="date-error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>


                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label class="fieldText">Skype</label><span
                                                        class="spanspan"></span><i class="fa fa-skype"></i>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <div class="row">
                                                        <div class="col-md-6"><input type="text" name="skype"
                                                                                     value="{{$user->nickname}}"
                                                                                     class="nameStyle"></div>
                                                        <div class="col-md-6"><span class="hide"
                                                                                    id="nickname-error"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label class="fieldText">Email</label><span
                                                        class="spanspan"></span><i class="fa fa-envelope-o"></i>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    {{$user->email}}
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label class="fieldText">Ngày tham gia</label>
                                                </div>
                                                <div class="col-md-8 col-6">


                                                    {{ date('Y-m-d', strtotime($user->created_at)) }}


                                                </div>
                                            </div>
                                            <hr/>

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label class="fieldText">Giới thiệu bản thân</label>
                                                </div>
                                                <div class="col-md-9 col-6">
                                                    <textarea rows="5" name="info" style="width: 100%;border: none"
                                                              maxlength="500">{{$user->info}}{{ old('info') }}</textarea>
                                                    <span class="hide" id="info-error"></span>
                                                </div>
                                            </div>
                                            <hr/>
                                            <a>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </a>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="source/js/profile.js"></script>
@endpush

