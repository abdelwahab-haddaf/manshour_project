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
@section('out-content')
    <div class="modal fade" id="staticBackdrop" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered">
            <form method="post" action="{{url('advertisements/delete')}}" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{__('web.Advertisement.Delete.delete_reason')}}</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="advertisement_id" id="advertisement_id">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="delete_reason" hidden></label>
                            <textarea class="form-control" id="delete_reason" name="delete_reason" required rows="5" placeholder="{{__('web.Advertisement.Delete.what_is_delete_reason')}}"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>{{__('web.Advertisement.Delete.did_you_sell_the_product')}}</p>
                            <span class="radio-item  row">
                                <div class="col-lg-5 flex-r">
                                    <input type="radio" id="sold_inside" name="sell_type" class="false" value="{{\App\Helpers\Constant::ADVERTISEMENT_SELL_TYPE['InsideWebsite']}}" checked="checked">
                                    <label for="sold_inside"><span>{{__('web.Advertisement.Delete.sold_inside_website')}}</span></label>
                                </div>
                                <div class="col-lg-7" id="sell_price_div">
                                    <label for="sell_price" hidden></label>
                                    <input type="text" name="sell_price" id="sell_price" placeholder="{{__('web.Advertisement.Delete.sold_price')}}" class="form-control">
                                </div>
                            </span>
                            <span class="radio-item row pb-2">
                                <input type="radio" id="sold_outside" name="sell_type" class="true" value="{{\App\Helpers\Constant::ADVERTISEMENT_SELL_TYPE['OutsideWebsite']}}">
                                <label for="sold_outside"><span>{{__('web.Advertisement.Delete.sold_outside_website')}}</span></label>
                            </span>
                            <span class="radio-item row">
                                <input type="radio" id="never_sold" name="sell_type" class="true" value="{{\App\Helpers\Constant::ADVERTISEMENT_SELL_TYPE['NeverSell']}}">
                                <label for="never_sold"><span>{{__('web.Advertisement.Delete.never_sold')}}</span></label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="row">{{__('web.Advertisement.Delete.commission_reminder')}}</p>
                    <p class="row">{{__('web.Advertisement.Delete.commission_value')}} <span id="CommissionValue">0</span></p>
                    <br>
                    <div class="row w-100">
                        <div class="col-lg-1"></div>
                        <div class="col-lg delete-b">
                            <button class="btn btn-add my-2 my-sm-0 mb-2 detail-btn" type="submit">{{__('web.Advertisement.delete_advertisement')}} </button>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.advertisements_list')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="ads-list container-fluid" style="min-height: 25vh">
        <div class="row">
            <div class="col-lg-12 all-media">
                @foreach ($Advertisements as $advertisement)
                    <div class="media">
                        <div class="row">
                            <div class="col-lg-2 col-2 p-0 d-flex"><img class="m-0 p-0" src="{{asset($advertisement->first_media->file)}}" alt="..."></div>
                            <div class="col-lg-10 col-md-10 col-10">
                                <div class="row">
                                    <div class="col-lg-9 col-md-8 col-9 media-body">
                                        <h5 class="mt-0">{{$advertisement->getTitle()}}</h5>
{{--                                        <p class="m-0"> {{ (strlen($advertisement->getContent()) > 100)?substr($advertisement->getContent(), 0, 99):$advertisement->getContent()}} </p>--}}
                                    </div>
                                    <div class="col-lg-3 col-md-4 p-0-mob col-3 d-flex">
                                        <div class="row">
                                            <div class="col-lg-12 m-b-m mob-bott">
                                                <button class="btn btn-add my-2 my-sm-0 mb-2 detail-btn" type="button" data-toggle="modal" data-target="#staticBackdrop" onclick="document.getElementById('advertisement_id').value = '{{$advertisement->id}}'">{{__('admin.delete')}} </button>
                                            </div>
                                            <div class="col-lg-12 m-b-m mob-bott">
                                                <button class="btn my-2 my-sm-0 adds-name detail-btn"  onclick="window.location = '{{url('advertisements/edit?advertisement_id='.$advertisement->id)}}'">{{__('admin.edit')}} </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row resp-s">
                                    <div class="col-lg-9 col-md-8 col-9 p-0">
                                        <div class="row b-top">
                                            <span class="col-lg-6 col-6 media-date">{{$advertisement->city->getName()}} <i class="fas fa-map-marker-alt"></i></span>
                                            <span class="col-lg-6 col-5 media-date">{{\Carbon\Carbon::parse($advertisement->created_at)->diffForHumans()}} <i class="far fa-clock"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col mb-4" id="Paging">
                {{ $Advertisements->links('vendor.pagination.default') }}
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('input[name="sell_type"]').change(function (){
            if($(this).val() === '{{\App\Helpers\Constant::ADVERTISEMENT_SELL_TYPE['InsideWebsite']}}'){
                $('#sell_price_div').show();
            }else{
                $('#sell_price_div').hide();
                $('#CommissionValue').text(0);
                $('#sell_price').val('');
            }
        });
        $('#sell_price').keyup(function () {
            $('#CommissionValue').text(parseFloat($(this).val())*0.5/100);
        });
    </script>
@endsection
