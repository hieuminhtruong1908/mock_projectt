@push('css')
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{asset('source/css/groupheader.css')}}">
@endpush
<div id="cover">
    <div class="container-fluid cover-imagee" id="imgProfileCover"
         style="background-image: url('{{asset("source/img/group/$group->thumbnail")}}')">
        <div>
            @if(Auth::user()->id == $caption->id)
                <form id="form_upload_cover" enctype="multipart/form-data"
                      action="{{route('group.uploadCover',$group->id)}}">
                    @CSRF
                    <input type="button" class="btn btn-secondary btn-secondary1"
                           id="btnChangePictureCover" value="">
                    <input type="file" style="display: none;" id="profilePictureCover"
                           name="uploadCover"/>
                </form>
            @endif
        </div>
        <div class="container">
            <div style="display: flex;padding-top: 23%">
                <div style="width: 14%;height: 150px">
                    <div class="image-container">
                        <img src='{{asset("source/img/group/".$group->slug)}}'
                             id="imgProfile"
                             style="width: 150px; height: 150px" class="img-thumbnail"/>
                        <div class="middle">
                            @if(Auth::user()->id == $caption->id)
                                <form id="formupload" enctype="multipart/form-data"
                                      action="{{route('group.uploadAvatar',$group->id)}}">
                                    @CSRF
                                    <input type="button" class="btn btn-secondary" id="btnChangePicture"
                                           value="Change"/>
                                    <input type="file" style="display: none;" id="profilePicture"
                                           name="upload"/>
                                    <input id="id-group" value="{{$group->id}}" style="display: none">
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="detail_group" style="width: 14%;height: 150px">
                    <div class="detail_group_name">
                        <h3 style="color: white;width: 200px">{{$group->name}}</h3>
                        <div>
                            @if(Auth::user()->id != $caption->id && !$viewPermission && !$waitting)
                                <a href="{{route('member.wanttolearn',[$group->id,Auth::user()->id])}}" ><button id="want-to-learn" >want to learn</button></a>
                            @endif

                            @if($viewPermission)
                                    <select id="leaved" style="color:white;">
                                        <option selected="selected" disabled>Joined</option>
                                        <option name="leave" id="leave" value="{{Auth::user()->id}}">Leave</option>
                                    </select>
                            @endif
                            @if($waitting)
                                <button disabled>Waitting</button>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        var uploadAvatarUrl = '{{config('constant.domain')}}/group/home/uploadavatar/{{$group->id}}';
        var uploadCoverUrl = '{{config('constant.domain')}}/group/home/uploadcover/{{$group->id}}';
        var idMember = '{{Auth::user()->id}}';
        var leaveURL = '{{config('constant.domain')}}/member/leave/{{$group->id}}/'+idMember;
    </script>
    <script src="{{asset('source/js/group/pendingmember.js')}}"></script>
@endpush
