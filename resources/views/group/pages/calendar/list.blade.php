{{--@push('css')--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('source/css/fullcalendar.min.css') }}">--}}
{{--@endpush--}}

{{--<div class="tab-pane fade" id="pills-calendar" role="tabpanel" aria-labelledby="pills-calendar-tab">--}}


{{--    <div class="panel-body">--}}
{{--        <div id="calendar"></div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--@push('scripts')--}}
{{--    <script src="{{asset('source/js/jquery/moment.min.js')}}"></script>--}}
{{--    <script src="{{asset('source/js/jquery/fullcalendar.min.js')}}"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('#calendar').fullCalendar({--}}
{{--                header: {--}}
{{--                    left: 'prev,next today myCustomButton',--}}
{{--                    center: 'title',--}}
{{--                    right: 'month,basicWeek,basicDay'--}}
{{--                },--}}

{{--                selectable: true,--}}

{{--                events : [--}}
{{--                        @foreach($events as $event) {--}}
{{--                        title : '{{ $event->title }}',--}}
{{--                        start : '{{ $event->start_date }}',--}}
{{--                    },--}}
{{--                    @endforeach--}}
{{--                ],--}}

{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
