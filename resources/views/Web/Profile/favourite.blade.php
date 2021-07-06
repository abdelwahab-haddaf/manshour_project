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
                @foreach ($Objects as $advertisement)
                    <div class="media">
                        <div class="row">
                            <div class="col-lg-2 col-2 p-0 d-flex"><img class="m-0 p-0" src="{{asset($advertisement->first_media->file)}}" alt="..."></div>
                            <div class="col-lg-10 col-md-10 col-10">
                                <div class="row">
                                    <div class="col-lg-9 col-md-8 col-9 p-0 media-body">
                                        <h5 class="mt-0">{{$advertisement->getTitle()}}</h5>
{{--                                        <p class="m-0"> {{ (strlen($advertisement->getContent()) > 100)?substr($advertisement->getContent(), 0, 99):$advertisement->getContent()}} </p>--}}
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-3 p-0 d-flex">
                                        <div class="row">
                                            <div class="col-lg-12 m-b-m mob-bott"><button class="btn btn-add my-2 my-sm-0 mb-2 detail-btn" type="button"  onclick="window.location = '{{url('advertisements/show?advertisement_id='.$advertisement->id)}}'">{{__('web.Home.details')}} </button></div>
                                            <div class="col-lg-12 m-b-m mob-bott"><button class="btn my-2 my-sm-0 adds-name detail-btn" type="button">{{$advertisement->user->name}}</button></div>
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
                                    <div class="col-lg-3 col-md-4 col-3 p-0 d-flex add-to-fav-pc">
                                        <div class="col-lg-12 mob-bott pt-2 pb-2">
                                            <div class="text-center" id="ToggleFav-{{$advertisement->getId()}}">
                                                <span class="add-to-fav color" onclick="ToggleFav({{$advertisement->getId()}})">{{__('web.Home.remove_from_fav')}}  <i class="fas fa-heart"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-3 mob-bott add-to-fav-mob">
                                        <div class="mob-bott"><div class="text-center" id="ToggleFav-{{$advertisement->getId()}}"><span class="add-to-fav color" onclick="ToggleFav({{$advertisement->getId()}})"><i class="fas fa-heart"></i></span></div></div>
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
                {{ $Objects->links('vendor.pagination.default') }}
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
            }
        });
        function ToggleFav(id){
            $.post( "{{url('advertisements/response/toggle_fav')}}", {advertisement_id:id,_token:'{{csrf_token()}}'},function( response ) {
                if (response.status.status === 'success'){
                    if (response.data){
                        $('#ToggleFav-'+id).html('<span class="add-to-fav" onclick="ToggleFav('+id+')"> {{__('web.Home.remove_from_fav')}}<i class="fas fa-heart"></i></span>');
                    }else{
                        $('#ToggleFav-'+id).html('<span class="add-to-fav color" onclick="ToggleFav('+id+')"> {{__('web.Home.add_to_fav')}}<i class="far fa-heart"></i></span>');
                    }
                }
            });
        }
    </script>
@endsection
