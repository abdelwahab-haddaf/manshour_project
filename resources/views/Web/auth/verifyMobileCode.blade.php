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
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="login-form form" action="{{route('setNewPassword')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="verification_code">{{__('auth.verification_code')}}</label>
                                <input type="number"
                                       class="form-control" name="verification_code" id="verification_code" aria-describedby="helpId" placeholder="" required>
                            </div>

                            <div class="form-group">
                                <label for="password">{{__('auth.password')}}</label>
                                <input type="password"
                                       class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="" required>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">{{__('auth.password_confirmation')}}</label>
                                <input type="password"
                                       class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="helpId" placeholder="" required>
                            </div>

                            <div class="form-group">
                              @php
                           /*
                                if (session()->get('data') != null){
                                $data = session()->get('data');
                              }
                            */
                              @endphp
                                <input type="hidden" name="token" value="{{isset($data) ? $data->token : ''}}" >
                                <input type="hidden" name="user_id" value="{{isset($data) ? $data->user_id : ''}}" >
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="{{__('auth.save_password')}}">
                            </div>


                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
