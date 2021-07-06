@extends('Web.layouts.app')
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.faq')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="faq container-fluid" style="min-height: 25vh">
        <div class="row">
            <div class="col-md-12">
                <div class="accordion">
                    @foreach(\App\Models\Faq::where('is_active',true)->get() as $Faq)
                        <div class="accordion-item">
                            <div class="accordion-item-header">
                                {{(app()->getLocale()== 'ar')?$Faq->getQuestionAr():$Faq->getQuestion()}}
                            </div>
                            <div class="accordion-item-body">
                                <div class="accordion-item-body-content">
                                    {{(app()->getLocale()== 'ar')?$Faq->getAnswerAr():$Faq->getAnswer()}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
