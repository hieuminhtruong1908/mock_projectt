@extends('layouts.index')

@push('css')
    <link rel="stylesheet" href="{{asset('source/css/detail-group.css')}}">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
@endpush
@section('title','Group | Home')
@section('content')
    @include('layouts.header')
    @include('group.layouts.header')

    <section class="section-rbg">
        <div class="container">
            <div class="row">
                <div class="col-md-9 rbg-color">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-content-tab" data-toggle="pill" href="#pills-content"
                               role="tab" aria-controls="pills-content" aria-selected="true">Content</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-member-tab" data-toggle="pill" href="#pills-member" role="tab"
                               aria-controls="pills-member" aria-selected="false">Member</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-attendance-tab" data-toggle="pill" href="#pills-attendance"
                               role="tab" aria-controls="pills-attendance" aria-selected="false">Attendance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-calendar-tab" data-toggle="pill" href="#pills-calendar"
                               role="tab" aria-controls="pills-calendar" aria-selected="false">Calendar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-pendingItem-tab" data-toggle="pill" href="#pills-pendingItem"
                               role="tab" aria-controls="pills-pendingItem" aria-selected="false">Pending Item
                            </a>
                            @if(Auth::user()->id == $group->author->id)

                                @if(!$rolePendingMember->isEmpty() || !$contentPending->isEmpty())
                                <input class="rounded-circle pending" disabled
                                    {! value="{{count($rolePendingMember)+count($contentPending)}}" !}
                                />
                                   @else
                                       {{""}}
                                @endif
                            @endif


                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Auth::user()->id != $caption->id) {{'disabled'}} @endif"
                               id="pills-setting-tab" data-toggle="pill" href="#pills-setting"
                               role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row section-m1 mt-5">
                <div class="col-md-9 col-sm-9 col-xs-9 section-m2">
                    <div class="tab-content" id="pills-tabContent">
                        <!--Content-->@include('group.pages.content.list')
                        <!--Member--> @include('group.pages.member.list')
                    <!-- Attendance-->@include('group.pages.attendance.index')
                        <!--Calendar-->@include('group.pages.calendar.list')
                        {{-- PendingItem--}}@include('group.pages.pendingitem.index')

                    <!--Setting-->@include('group.pages.setting.index')
                    </div>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="d-flex align-items-center height-background bgra">
                        <div class="rounded size-width">
                            <form method="POST" action="{{route('member.add',$group->id)}}">
                                @csrf
                                <input class="member-input" type="text" name="member" id="member"
                                       placeholder="   Add member to this group" oninput="search(this)"
                                       autocomplete="off"

                                @if(Auth::user()->id != $group->author->id && !$viewPermission) {{'disabled'}} @endif
                                >
                                <button type="submit"  @if(Auth::user()->id != $group->author->id && !$viewPermission) {{'disabled'}} @endif><i class="fas fa-plus button-add"></i></button>
                            </form>
                        </div>

                    </div>
                    <div id="memberList" >
                        <ul class="dropdown-menu rgba-show-member" id="member-search">

                        </ul>
                    </div>
{{--                    <div class=" margin-top datepicker bgra">--}}
{{--                        <input id="datepicker" width="100%"/>--}}
{{--                    </div>--}}
                    <div class="margin-top">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Group infomation</h5>
                                </div>
                                <div class="margin-top margin-left">
                                    <div class="border-bottom margin-top"><i class="fas fa-clock"></i>
                                        &emsp;{{$group->start_date}}</div>
                                    <div style="color: #ff6119" class="border-bottom margin-top"><i
                                            class="fas fa-star"></i> &emsp;{{$group->author->name}}
                                    </div>
                                    <div style="color: #ff6119" class="border-bottom margin-top"><i
                                            class="far fa-user"></i> &emsp;
                                        @foreach($roles as $role)
                                            @if($role->is_mentor){{$role->user->name}}
                                            @break
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="border-bottom margin-top"><i class="far fa-user"></i>
                                        &emsp; {{count($roles)+1}}</div>
                                    <div class="border-bottom margin-top"><i class="far fa-calendar-alt"></i> &emsp;AAA
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="margin-top">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">Important Links</h5>
                                </div>
                                <div class="margin-left">
                                    <p><a class="font-clor" href="#">Google</a></p>
                                    <p><a class="font-clor" href="#">Redmine</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
@endsection()
@push('scripts')
    <script>
        $(document).ready(function () {
           let hash = window.location.hash;
           let tab = subTab = "";
            if (hash.length == 0) {
                $('#pills-content-tab').addClass('active');
                $('#pills-content').addClass('active show')
            } else {
                if (hash.indexOf('&') != -1){
                    $('#pills-content-tab').removeClass('active');
                    tab = hash.substr(0,hash.indexOf('&'));
                    subTab = hash.substr(hash.indexOf('&')+1);
                     $(tab+'-tab').addClass('active');
                     $(tab).addClass('active show');
                    $(subTab+'-tab').addClass('active');
                    $(subTab).addClass('active show');
                }
                $('#pills-content-tab').removeClass('active');
                $(`${hash}-tab`).addClass('active');
                $(`${hash}`).addClass('active show')
            }
        });
    </script>

    <script src="{{asset('source/js/group/uploadavatar.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#member-search li').on('click', function () {
                $('#member').val($(this).text());
                $('#memberList').fadeOut();
            });
        });

        function search(obj) {
            var query = obj.value;

            if (query != "") {
                $.ajax({
                    url: "{{ Route('member.fetch')}}",
                    method: "POST",
                    data: {query: query},
                    success: function (data) {
                        $('#member-search').fadeIn();
                        $('#member-search').html(data);
                    },
                    error: function (error) {
                        console.log(error.responseJSON);
                    }
                })
            }
        };
    </script>
@endpush
