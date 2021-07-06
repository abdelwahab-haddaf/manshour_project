@extends('Web.layouts.app')
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.contact_us')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <form action="{{url('contact_us')}}" method="post" class="contact-us" style="min-height: 25vh">
        @csrf
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="username" class="text-info">{{__('web.User.username')}}</label>
                    <input type="text" name="name" required id="username" value="{{old('name')}}" placeholder="{{__('web.User.username')}}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="email" class="text-info">{{__('web.User.email')}}</label>
                    <input type="email" name="email" required id="email" value="{{old('email')}}" placeholder="{{__('web.User.email')}}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="mobile" class="text-info">{{__('web.User.mobile')}}</label>
                    <input type="tel" name="mobile" required value="{{old('mobile')}}" id="mobile" placeholder="{{__('web.User.mobile')}}" class="form-control @error('mobile') is-invalid @enderror">
                    @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="type">{{__('crud.Ticket.type')}}</label>
                    <select id="type" name="type" required class="form-control @error('type') is-invalid @enderror">
                        @foreach(\App\Helpers\Constant::TICKETS_TYPE as $i)
                            <option value="{{$i}}" @if($i ==old('type')) selected @endif>{{__('crud.Ticket.Types.'.$i)}}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="message" class="text-info">{{__('crud.Ticket.message')}}</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" placeholder="{{__('crud.Ticket.message')}}">{{old('message')}}</textarea>
                    @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9"></div>
            <div class="col-lg-3">
                <div class="form-group">
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info btn-md  contact-btn" value="{{__('admin.Home.n_send')}}">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
