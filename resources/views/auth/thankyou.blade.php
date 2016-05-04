@extends('adminlte::layouts.auth')

@section('htmlheader_title')
   Thank you
@endsection

@section('content')
<body class="hold-transition login-page">
<div class="login-box" style="width:30%">

    {{--@include('adminlte::partials.flash')--}}

    After verification you will be able to <a href="{{ url('/login') }}" class="text-center">Login</a> into you account

</div><!-- /.login-box -->

</body>

@endsection
