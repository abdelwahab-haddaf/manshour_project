@extends('Web.layouts.app')
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.privacy_and_conditions')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="privacy-trems container-fluid" style="min-height: 25vh">
        <div class="row">
            <div class="col-md-12">
                <p>{{(app()->getLocale()=='ar')?$Privacy->getValueAr():$Privacy->getValue()}}</p>
            </div>
        </div>
    </section>

@endsection
