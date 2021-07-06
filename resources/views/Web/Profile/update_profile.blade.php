@extends('Web.layouts.app')
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.update_profile')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="login register" style="min-height: 25vh">
        <div class="container">
            <div class="row login-row justify-content-center align-items-center">
                <div class="login-column col-md-7">
                    <div class="login-box col-md-12">
                        <div class="login-img">
                            <img src="{{asset('web/img/login.png')}}" alt="">
                        </div>
                        <form class="login-form form" action="{{ url('profile/post_update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 l-r-s">
                                    <div class="form-group">
                                        <label for="name" class="text-info">{{__('web.User.username')}}</label>
                                        <input type="text" name="name" required id="name" placeholder="{{__('web.User.username')}}" class="form-control @error('name') is-invalid @enderror" value="{{ auth()->user()->name }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 l-l-s">
                                    <div class="form-group">
                                        <label for="email" class="text-info">{{__('web.User.email')}}</label>
                                        <input type="email" name="email" required id="email" placeholder="{{__('web.User.email')}}" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 l-r-s">
                                    <div class="form-group">
                                        <label for="city_id">{{__('web.User.city')}}</label>
                                        <select id="city_id" required name="city_id" class="form-control @error('city_id') is-invalid @enderror">
                                            @foreach(\App\Models\City::where('is_active',true)->get() as $City)
                                                <option value="{{$City->getId()}}" @if(auth()->user()->city_id == $City->getId()) selected @endif>{{(app()->getLocale() == 'ar')?$City->getNameAr():$City->getName()}}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 l-l-s">
                                    <div class="form-group">
                                        <label for="mobile" class="text-info">{{__('web.User.mobile')}}</label>
                                        <input type="tel" name="mobile" required id="mobile" placeholder="{{__('web.User.mobile_example')}}" class="form-control @error('mobile') is-invalid @enderror" value="{{auth()->user()->mobile}}">
                                        @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 l-l-s">
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-info btn-md" value="{{__('admin.save')}}">
                                    </div>
                                </div>
                            </div>
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
