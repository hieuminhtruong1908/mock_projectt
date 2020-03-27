@extends('layouts.index')
@push('css')
    <link rel="stylesheet" href="/source/css/listgroup.css">
@endpush
@section('title', 'List group')
@section('content')
    @include('layouts.header')
    @include('layouts.slide')
    <!--content-->
    <div id="content">
        <div class="container">
            <div class="group-name">
                <a href="/home">Home</a> / {{ $course->name }}
            </div>
            <div class="row mt-2">
                <div class="col-lg-4 block-detail-group">
                    <div class="group-coming-soon">
                        <span>Group Coming Soon</span>
                    </div>
                </div>
            </div>
            <div class="row mt-3">

                @foreach ($coming as $group)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <a href="{{route('group.detail',$group->id)}}">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{$group->name}}</h5>
                                    <div class="group-detail">
                                        <div class="postrait">
                                            <i class="fas fa-portrait"></i><span> {{count($group->roles)+1}} members</span>
                                        </div>
                                        <div class="event">
                                            <i class="fas fa-pen"></i><span> 0 events</span>
                                        </div>
                                        <div class="captain">
                                            <i class="far fa-star"></i>
                                            <span>
                                                @if(isset($group->author->name))
                                                    {{$group->author->name}}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="calendar">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>
                                                {{$group->start_date}}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="card-text des-group">{{$group->description}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

            <div class="row mt-5">
                <div class="col-lg-4 block-detail-group">
                    <div class="group-running">
                        <span>Group Running</span>
                    </div>
                </div>
            </div>
            <div class="row mt-4">

                @foreach ($running as $group)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6" style="margin-top: 20px">
                        <a href="{{route('group.detail',$group->id)}}">
                            <div class="card">
                                <div class="card-body" >
                                    <h5 class="card-title">{{$group->name}}</h5>
                                    <div class="group-detail" style="height: 80px">
                                        <div class="postrait">
                                            <i class="fas fa-portrait"></i><span> {{count($group->roles)+1}} members</span>
                                        </div>
                                        <div class="event">
                                            <i class="fas fa-pen"></i><span> 0 events</span>
                                        </div>
                                        <div class="captain">
                                            <i class="far fa-star"></i>
                                            <span>
                                                @if(isset($group->author->name))
                                                    {{$group->author->name}}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="calendar">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>
                                                {{$group->start_date}}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="card-text des-group">{{$group->description}}</p>
                                </div>
                            </div>
                         </a>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="row">
            <div id="logo" class="col-lg-5 col-md-5 col-sm-12"></div>
            <div id="menu" class="col-lg-7 col-md-7 col-sm-12 mt-4"><button type="button" class="btn btn-lg btn-info" data-toggle="modal" data-target="#myModel">+ Create Group</button></div>
        </div>
        <div class="modal fade" id="myModel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create New Group</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="post" id="createGroup">
                            @csrf
                            <div class="form-group">
                                <label for="name">Your Group Name</label>
                                <input type="text" class="form-control" name="group" id="group" maxlength="64">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3" maxlength="255"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="dateofbirth">Start Date</label>
                                <input class="form-control" type="date" name="start">
                            </div>
                            <div class="form-group">
                                <label>Course</label>
                                <input class="form-control" type="text" value="@if(isset($course)) {{$course->name}} @endif" disabled>
                            </div>
                            <button type="submit" class="btn btn-success mt-3 float-lg-right m-3">Done</button>
                            <button type="button" onclick="resetForm()" class="btn btn-light mt-3 float-lg-right" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end content-->
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="/source/js/group/validation.js"></script>
    <script src="/source/js/group/resetData.js"></script>
@endpush
