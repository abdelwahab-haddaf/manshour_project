@extends('Web.layouts.app')
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.update_user_info')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="account-sitting">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="username" class="text-info">{{__('web.User.username')}}</label>
                    <input type="text" name="username" required id="username" placeholder="{{__('web.User.username')}}" class="form-control">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="email" class="text-info">{{__('web.User.email')}}</label>
                    <input type="email" name="email" required id="email" placeholder="{{__('web.User.email')}}" class="form-control">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="city_id">{{__('web.User.city')}}</label>
                    <select id="city_id" required name="city_id" class="form-control">
                        @foreach(\App\Models\City::where('is_active',true)->get() as $City)
                            <option value="{{$City->getId()}}">{{(app()->getLocale()=='ar')?$City->getNameAr():$City->getName()}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="mobile" class="text-info">{{__('web.User.mobile')}}</label>
                    <input type="tel" name="mobile" required id="mobile" placeholder="{{__('web.User.mobile_example')}}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <div class="row">
                        <label for="password-field" class="text-info col pr-0">{{__('web.User.password')}}</label>
                    </div>
                    <input type="password" name="password" id="password-field" placeholder="{{__('web.User.password')}}" class="form-control">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
            </div>
            <div class="col-lg-6">
            </div>
            <div class="col-lg-3 delete-b">
                <div class="form-group">
                    <label for="username" class="text-info"><br></label>
                    <button class="btn btn-add my-2 my-sm-0 mb-2 detail-btn" type="submit">{{__('web.update_user_info')}}</button>
                </div>
            </div>
        </div>
    </section>
@endsection
