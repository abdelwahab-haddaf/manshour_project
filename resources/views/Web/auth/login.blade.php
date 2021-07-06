@extends('Web.layouts.app')
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.login')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="login">
        <div class="container">
            <div class="row login-row justify-content-center align-items-center">
                <div class="login-column col-md-5">
                    <div class="login-box col-md-12">
                        <div class="login-img">
                            <img src="{{asset('Web/img/login.png')}}" alt="">
                        </div>
                        <form class="login-form form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="mobile" class="text-info">{{__('web.User.mobile')}}</label>
                                <input type="tel" name="mobile" required id="mobile" placeholder="{{__('web.User.mobile_example')}}" value="{{ old('email') }}" class="form-control @error('mobile') is-invalid @enderror">
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                @if (Route::has('password.request'))
                                    <div class="row">
                                        <label for="password-field" class="text-info col pr-0">{{__('web.User.password')}}</label>
                                        <a href="{{route('password.request')}}" class="col pl-0">{{__('web.have_you_forget_password')}}</a>
                                    </div>
                                @endif
                                <input type="password" name="password" required id="password-field" placeholder="{{__('web.User.password')}}" class="form-control">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="{{__('web.login')}}">
                            </div>
                            <hr>
                            <div class="text-right register-link mb-2">
                                <span> {{__('web.dont_have_account')}} &nbsp; <a href="{{url('register')}}" class="text-info"> {{__('web.register')}} </a></span>
                            </div>

                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("fas fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endsection
