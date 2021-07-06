@extends('Web.layouts.app')
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.site_commission')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="site-commission container-fluid" style="min-height: 25vh">
        <div class="row">
            <div class="col-md-12">
                <p>{{(app()->getLocale()=='ar')?$Commission->getValueAr():$Commission->getValue()}} </p>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12 ">
                <div class="row">
                    @foreach(\App\Models\BankAccount::all() as $bankAccount)
                        <div class="col-sm-4 commission-details">
                            <a href="javascript:;">
                                <div class="card">
                                    <div class="card-body">
                                        <ul>
                                            <li> <span>{{__('crud.BankAccount.bank_name')}}</span> : <span>{{$bankAccount->getBankName()}}</span></li>
                                            <li @if(app()->getLocale() == 'ar') style="text-align: right" @endif> <span>{{__('crud.BankAccount.account_name')}}</span> : <span>{{$bankAccount->getAccountName()}}</span></li>
                                            <li> <span>{{__('crud.BankAccount.account_number')}}</span> : <span>{{$bankAccount->getAccountNumber()}}</span></li>
                                            <li> {{__('crud.BankAccount.account_iban')}} : <span>{{$bankAccount->getAccountIban()}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
