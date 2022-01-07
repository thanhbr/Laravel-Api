@extends('layouts.root')
@section('css')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="/app-assets/fonts/feather/style.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    @include('layouts.contents.theme-upos')
    <style type="text/css">
        #login .logo-upos{}
        #login .card{max-width: 480px; margin: 0px auto; background-color: inherit;}
        #login .card .card-body {background-color: #fff;border-radius: 6px;}
        #login .card .card-body .card-block {padding: 32px 40px;}
        #login .card .card-body .block-1 h4{color: #172E4D;font-size: 18px;}
        #login .card .card-body .block-1 p{font-size: 12px;}
        #login .card .card-body .block-1{color: #7D9AC0;}
        #login .card .card-body .block-2{}
        #login .card .card-body .block-2 input {min-width: 250px;}
        #login .card .card-body .btn-login{color: #fff;background-color: #3CD6B7; margin: 0px auto;}
        #login .card .card-body label.form-control{border: none}
        #login .card .card-body .reset-password {color: black}
        #login .card .card-body .reset-password > span {color: #1976d2;}
    </style>
@endsection
@section('script-head')
  <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
@endsection
@section('body')
    <body>
        <div id="login" class="d-flex">
            <div class="container d-flex align-items-center">
                <form id="form_login" method="POST" action="{{ route('login') }}" >
                    <div class="row p-2 logo-upos">
                        <div class="col-lg-12 text-xs-center">
                            <img src="{{ asset('images/upos-icon-w140.png') }}" alt="Logo Upos" height="42px" width="140">
                        </div>
                    </div>
                    <div class="card">
                        @csrf
                        <div class="card-body">
                            <div class="card-block">
                                <div class="row text-xs-center block-1">
                                    <h4 class="text-uppercase">Đăng nhập</h4>
                                    <p class="text-xs-center">Nhập thông tin để truy cập vào tài khoản của bạn</p>
                                    @if($errors->has('notice'))
                                    <div class="col-12 p-2">
                                        <span class="alert alert-danger help-block">
                                            <strong>{{ $errors->first('notice')}}</strong>
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                <div class="row ">
                                    <div class="col-xs-12">
                                        <label for="email" class="mb-0 form-control">
                                            <span>Mã nhân viên/Email</span>
                                            <input id="email" type="text" style="margin-top: 5px" class=" form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="">
                                            <input id="id" type="text" class="form-control" hidden name="name" value="" >
                                        </label>
                                        <span id="hb-username" class="help-block">
                                            <strong>{{ $errors->first('email')}}{{ $errors->first('id') }}</strong>
                                        </span>
                                    </div>
                                    <div class="col-xs-12">
                                        <label for="password" class="mb-0 form-control">
                                            <span>Mật khẩu</span>
                                            <input id="password" type="password" style="margin-top: 5px" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" minlengthp="6" required placeholder="">
                                        </label>
                                        <span id="hb-password" class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    </div> 
                                    <div class="col-xs-12 pt-1 pb-0 ">
                                        <div class="text-xs-center" style="padding: 0px 12px">
                                            <button type="submit" class="btn btn-login" style="width: 100%">
                                                {!! trans('titles.login') !!}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group d-none">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {!! trans('auth.rememberMe') !!}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row block-3">
                                    <div class="col-xs-12 text-sm-center">
                                        <a class="btn reset-password " href="{{ route('password.request') }}">Quên mật khẩu? <span>Đặt lại mật khẩu</span></a>
                                    </div>
                                    <div class="col-xs-12">
                                       {{--  <button type="submit" class="btn btn-login">
                                            {!! trans('titles.login') !!}
                                        </button> --}}
                                    </div>
                                </div>
                                <div class="row align-text-bottom">
                                    <div class="col-12">
                                        {{-- @include('systems.version') --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#email').on('change, keyup', function(e){
                    $('#id').val($(this).val());
                    validate('email');
                })
                $('#password').on('change, keyup', function(e){
                    validate('password');
                })
            });
            let inputList = document.getElementsByTagName('input');
             $('#form_login').on('submit', function (e) {
                    // validate('email');
                })
            function validate(inputID) {
              const input = document.getElementById(inputID);
              const validityState = input.validity;
              if (input.value.length < 1) {
                input.classList.add("is-invalid");
              } else{
                console.log(input.value.length);
                input.classList.remove("is-invalid");
                $(input).closest('.col').find('.help-block').html('');
              }
            }
        </script>
    </body>
@endsection