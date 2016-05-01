@extends('adminlte::layouts.auth')

@section('htmlheader_title')
   Thank you
@endsection

@section('content')
<body class="hold-transition login-page">
<div class="login-box">
    @if(Session::has('register_success'))
        <div class="alert alert-success fade in">
            <strong>Success!</strong> {{ Session::get('register_success') }}
        </div>
    @endif

    After verification you will be able to <a href="{{ url('/login') }}" class="text-center">Login</a> into you account
</div><!-- /.login-box -->

</body>

@endsection
