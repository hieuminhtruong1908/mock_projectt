<div class="tab-pane fade" id="pills-setting" role="tabpanel"
     aria-labelledby="pills-setting-tab">

    <div class="container">

        <div class="row mt-15 mb-15" style="border-bottom: 1px solid grey">
            <div>
                <form method="post" action="{{route('setting.changeName',$group->id)}}" id="change-name">
                    @csrf
                    <div class="form-group">
                        <label for="name-group" style="font-size: 20px;color: #3300ff;">Changes your name group</label>
                        <input type="text" class="form-control mt-15" name="name" maxlength="64"
                               placeholder="Enter your name group">
                    </div>
                    <button type="submit" class="btn btn-primary mb-15">Submit</button>
                </form>
            </div>

        </div>


        <div class="row mt-15 mb-15" style="border-bottom: 1px solid grey">
            <div>
                <form method="post" action="{{route('setting.changeDes',$group->id)}}" id="change-description">
                    @csrf
                    <div class="form-group">
                        <label for="name-group" style="font-size: 20px;color: #3300ff;">Changes your description your group</label>
                        <textarea class="form-control" name="descr" id="descr" rows="5" maxlength="255">{{$group->description}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mb-15">Submit</button>
                </form>
            </div>

        </div>


        <div class="row mt-15 mb-15" style="border-bottom: 1px solid grey">
            <div class="col-md-6" style="padding: 0px">
                <form method="post" runat="server" action="{{route('setting.changeAvatar',$group->id)}}"
                      id="change-avatar" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name-group" style="font-size: 20px;color: #3300ff;">Changes your avatar
                            group</label>
                        <input type="file" style="border: none" class="form-control mt-15" name="avatar" id="avata">
                    </div>
                    <button type="submit" class="btn btn-primary mb-15">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <img src="{{asset('source/img/group/'.$group->slug)}}" id="img-change-avatar"
                     style="margin-bottom: 12px;" src="#">
            </div>
        </div>


        <div class="row mt-15 mb-15" style="border-bottom: 1px solid grey;">
            <div class="row">
                <div class="col-md-12 ml-1">
                    <form method="post" runat="server" action="{{route('setting.changeCover',$group->id)}}"
                          id="change-cover" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name-group" style="font-size: 20px;color: #3300ff;">Changes your cover
                                group</label>
                            <input type="file" style="border: none" class="form-control mt-15" name="changecover"
                                   id="input-cover">
                        </div>
                        <button type="submit" class="btn btn-primary mb-15">Submit</button>
                    </form>
                </div>
            </div>
            <div class="row" style="min-height: 600px;width: 100%">
                <img src="{{asset('source/img/group/'.$group->thumbnail)}}" class="img-fluid" id="changecover"
                     style="width: 100%" alt="Responsive image">
            </div>

        </div>


    </div>

</div>
@push('scripts')
    <script src="{{asset('source/js/group/setting.js')}}"></script>
@endpush


