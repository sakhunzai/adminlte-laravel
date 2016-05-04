@extends('adminlte::layouts.auth')

@section('htmlheader_title')
   Verify your email 
@endsection

@section('content')
<body class="hold-transition login-page">
<div class="login-box" style="width:30%">

    @include('adminlte::partials.flash')

    You may <a href="{{ url('/login') }}" class="text-center">Login</a> into your account after verfication.

</div><!-- /.login-box -->

</body>

@endsection
