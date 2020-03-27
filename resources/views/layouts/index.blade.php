<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta http-equiv="refresh" content="1800;url={{config('constant.domain')}}/logout" />
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <base href="{{asset('')}}">
    {{-- boostrap 4--}}
    <link rel="stylesheet" href="{{asset('source/css/bootstrap.min.css')}}">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{asset('source/style.css')}}">
    <!-- jQuery-2.2.4 js -->
@stack('css')

<!-- Title -->
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset('source/img/core-img/favicon.ico')}}">


</head>

<body>

@include('flashmessage')

@yield('content')

<script type="text/javascript" src="{{asset('source/js/jquery/jquery-3.4.1.min.js')}}"></script>
<!-- jQuery-2.2.4 js -->
<script src="{{asset('source/js/jquery/jquery-2.2.4.min.js')}}"></script>
<!-- Popper js -->
<script src="{{asset('source/js/bootstrap/popper.min.js')}}"></script>
<!-- Bootstrap js -->
<script src="{{asset('source/js/bootstrap/bootstrap.min.js')}}"></script>
<!-- All Plugins js -->
<script src="{{asset('source/js/plugins/plugins.js')}}"></script>
<!-- Active js -->
<script src="{{asset('source/js/active.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>

<script src="{{asset('source/js/flashmessage.js')}}"></script>

@stack('scripts')

<script>
    $.noConflict();
</script>

@include('sweetalert::alert')

</body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</html>
