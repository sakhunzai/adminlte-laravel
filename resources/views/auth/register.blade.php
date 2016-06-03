@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Register
@endsection

@section('content')

    <body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url('/home') }}">{!! $layout->logoLarge !!}</a>
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>
            <form action="{{ url('/register') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 
         @if( $register = @config('adminlte.auth.register') ) @endif
             
         @if ( isset($register) && isset($register['name']) )
            
            @foreach ($register['name'] as $name=>$label)
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="{{ $label }}" name="{{ $name }}" value="{{ old($name) }}"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
            @endforeach
              
         @else
                 <div class="form-group has-feedback">
                     <input type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}"/>
                     <span class="glyphicon glyphicon-user form-control-feedback"></span>
                 </div>
         @endif
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation"/>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                    @if(@config('adminlte.auth.register.terms_of_service',false))
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="terms_of_service"> I agree to the <a href="#" data-target="#terms_of_service" data-toggle="modal" >terms</a>
                            </label>
                        </div>
                    @endif
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div><!-- /.col -->
                </div>
            </form>
             @if(@config('adminlte.socialLogin'))
                @include('adminlte::auth.partials.social_login')
             @endif    

            <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>
        </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    @include('adminlte::layouts.partials.scripts_auth')
    
    @if(@config('adminlte.auth.register.terms_of_service',false))
        @include('adminlte::partials.terms_of_service')
    @endif
    
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
