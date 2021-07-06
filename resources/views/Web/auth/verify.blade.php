@extends('Web.layouts.app')
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.register')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="login send-register-code">
        <div class="container">
            <div class="row login-row justify-content-center align-items-center">
                <div class="login-column col-md-5">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A verification code has been sent to your mobile.') }}
                        </div>
                    @endif
                    <div class="login-box col-md-12">
                        <div class="login-img">
                            <img src="{{asset('web/img/login.png')}}" alt="">
                        </div>
                        <form class="login-form form" action="{{ url('auth/check_verify') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="code" class="text-info">{{__('web.verify_code')}}</label>
                                <input type="text" name="code" id="code" placeholder="" class="form-control @error('code') is-invalid @enderror">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <a href="{{url('auth/resend_verification')}}" class="col pl-0">{{__('web.resend_verification_code')}}</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="{{__('web.verify')}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
