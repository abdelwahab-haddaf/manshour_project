@extends('Web.layouts.app')
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.forget_password')}}</li>
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
                            <img src="{{asset('web/img/login.png')}}" alt="">
                        </div>
                        <form class="login-form form" action="" method="post">
                            <div class="form-group">
                                <div class="row">
                                    <label for="password-field" class="text-info col pr-0">{{__('web.User.new_password')}}</label>
                                </div>
                                <input type="password" name="password" id="password-field" placeholder="{{__('web.User.new_password')}}" class="form-control">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="password_confirmation" class="text-info col pr-0">{{__('web.User.password_confirmation')}}</label>
                                </div>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{__('web.User.password_confirmation')}}" class="form-control">
                                <span toggle="#password_confirmation" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="{{__('web.change_password')}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
