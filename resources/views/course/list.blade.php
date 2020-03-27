@if(isset($courses))
    <section>
        <div class="container">
            <div class="margin-bottom-top d-flex justify-content-between">
                <h3 style="width: 15%">Course</h3>
                @if(Auth::check())
                    <div class="range-top-10">
                        <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target=".bd-example-modal-lg" id="add-course">Add
                            Course
                        </button>

                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                             aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{route('course.create')}}" method="POST" id="createCourse">
                                        @csrf
                                        <div class="container">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name Course</label>
                                                <input type="text" class="form-control" id="course" name="course"
                                                       maxlength="64"
                                                       aria-describedby="emailHelp" placeholder="Name Course">
                                                <div class="color-red" id="errorCourse"></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Desciption</label>
                                                <textarea class="form-control" rows="4" id="description" type="text"
                                                          maxlength="500"
                                                          name="description" placeholder="Desciption"></textarea>
                                                <div class="color-red" id="errorDescription"></div>
                                            </div>

                                            <input style="margin-bottom: 10px" type="submit" name="addCourse"
                                                   class="btn btn-primary" value="Add">
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row">
                @foreach($courses as $course)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 range-top-20">
                        <a @if(Auth::check())     {{-- Chỉ cần Login là xem được gr  --}}
                           {! href="{{route('group.list', $course->id)}}" !}
                           @endif
                           style="text-decoration: none">
                            <div class="card">

                                <div class="card-body hv-bgr" style="height: 270px">

                                    <div class="rounded">
                                        <h3 class="name-course">{{$course->name}}</h3>
                                    </div>
                                    <div class="range-top-20">
                                        <div  class="border-bottom font-cs"><i class=" fas fa-award"></i> <i>Author
                                                :</i>@if (isset($course->author)) {{$course->author->name}}  @endif</div>
                                        <div class="border-bottom font-cs"><i class="fas fa-hourglass-start"></i> <i>Date
                                                : </i> {{ date('Y-m-d',strtotime($course->created_at))}}  </div>
                                        <div class="border-bottom font-cs"><i class="fas fa-file-alt"></i> <i>Desciption
                                                :</i>@if(strlen($course->description) >= 30) {{substr($course->description,0,23)}}
                                            . . .
                                            @else {{$course->description}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        @if(Auth::check() && isset($course->author) && $course->author->id == Auth::user()->id)
                            <div class="rol" style="margin-top: 6%;text-align: center">
                                <button type="button" class="edit" data-toggle="modal"
                                        data-target="#editCourse" data-id="{{$course->id}}"
                                        data-name="{{$course->name}}"
                                        data-des="{{$course->description}}">Edit Course
                                </button>

                            </div>
                        @endif

                    </div>
                @endforeach
                <div class="modal fade" id="editCourse" tabindex="-1" role="dialog"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div style="color: red;text-align: center;height: 30px;">
                                <p id="exist"></p>
                            </div>
                            <form id="edit">
                                @csrf
                                <div class="container">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name Course</label>
                                        <input type="text" class="form-control" id="name"
                                               name="name" maxlength="64" aria-describedby="emailHelp"
                                        >
                                        <p class="errorr" id="error-course"></p>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Desciption</label>
                                        <textarea class="form-control" rows="5" id="descriptionn" maxlength="500"
                                                  type="text" name="desciption">{{ old('desciption') }}</textarea>
                                        <p class="errorr" id="error-description"></p>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit"
                                                id="save">Save
                                        </button>
                                        <button type="button" class="btn btn-primary" id="cancel">
                                            Reset
                                        </button>
                                        <button type="button" style="margin-left: 60%" class="btn btn-secondary"
                                                id="close" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endif
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="source/js/course/validate.js"></script>
    <script src="source/js/course/edit.js"></script>
@endpush
