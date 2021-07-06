@extends('Web.layouts.app')
@section('style')
    <style>
        .pagination>li>a,.pagination>li>span{
            padding: 6px 12px 8px;
            border-radius: 12%;
            background: lightgray;
            margin: 2px;
            font-size: 16px;
        }
        .pagination>li>a:hover{
            text-decoration: none;
            color: #D41675 !important;
        }
        .pagination>li.active>span,.page-item.active .page-link{
            background: linear-gradient(90deg, rgba(212, 22, 117, 1) 0%, rgba(253, 54, 21, 1) 100%);
            border-color: transparent;
            color: #fff;
        }
    </style>
@endsection
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.notifications')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="notifications container-fluid" style="min-height: 25vh">
        <div class="row">
            <div class="col-lg-5">
                @foreach($Objects as $notification)
                    <a href="" class="col-lg-6">
                        <div class="alert alert-success" role="alert">
                            <span> <i class="fas fa-exclamation-circle alert-icon"></i>&nbsp; {{(app()->getLocale() == 'ar')?$notification->getTitleAr():$notification->getTitle()}} </span>
                            <p>{{(app()->getLocale()=='en')?$notification->getMessage():$notification->getMessageAr()}}</p>
                            <span class="mb-0">{{\Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col mb-4" id="Paging">
                {{ $Objects->links('vendor.pagination.default') }}
            </div>
        </div>
    </section>
@endsection
@section('script')
@endsection
