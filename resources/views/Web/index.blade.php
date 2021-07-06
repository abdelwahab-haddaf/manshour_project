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
    @if ((\App\Models\Banner::where('is_active',true)->count()>0))
        <div class="container-fluid pl-0 pr-0 homeCarousel">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach(\App\Models\Banner::where('is_active',true)->get() as $banner)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" @if($loop->index == 0) class="active" @endif></li>
                    @endforeach
                </ol>
                <div class="carousel-inner ">
                    @foreach(\App\Models\Banner::where('is_active',true)->get() as $banner)
                        <div class="carousel-item @if($loop->index == 0) active @endif" onclick="window.open('{{$banner->getUrl()}}','_blank')">
                            <img class="d-block w-100" src="{{asset($banner->getImage())}}" height="350" alt="{{$banner->getName()}}">
                        </div>
                    @endforeach
                    <div class="shape"></div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    @endif
    <section class="container-fluid services" style="min-height: 35vh">
        <section class="container-fluid mt-5 navs">
            <div class="row">
                <div class="col-lg-12 pl-0 pr-0">
                    <div class="row">
                        <div class="col-lg-8 col-12 p-0">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="category_0" onclick="LoadAdvertisement()" data-toggle="pill" href="#category_all">{{__('web.Home.all_categories')}}</a>
                                </li>
                                @foreach(\App\Models\Category::whereNull('parent_id')->get() as $category)
                                    <li class="nav-item">
                                        <a class="nav-link" id="category_{{$category->id}}" onclick="LoadAdvertisement({{$category->id}})" data-toggle="pill" href="#category_div_{{$category->id}}">{{(app()->getLocale() == 'ar')?$category->name_ar:$category->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="category_all" role="tabpanel">
                            <div class="navs-footer">
                                <hr>
                            </div>
                        </div>
                        @foreach(\App\Models\Category::whereNull('parent_id')->get() as $category)
                            @if(count($category->children)>0)
                                <div class="tab-pane fade" id="category_div_{{$category->id}}" role="tabpanel">
                                    <hr class="navs-hr">
                                    <ul class="nav nav-pills mb-3" id="pills-tab-1" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="sub_category_0" onclick="LoadAdvertisement({{$category->id}})" data-toggle="pill" href="#sub_category_all">{{__('web.Home.all_sub_categories')}}</a>
                                        </li>
                                        @foreach($category->children as $sub_category_1)
                                            <li class="nav-item">
                                                <a class="nav-link" id="category_{{$sub_category_1->id}}" onclick="LoadAdvertisement({{$category->id}},{{$sub_category_1->id}})" data-toggle="pill" href="@if(count($sub_category_1->children)>0) #category_div_{{$sub_category_1->id}}@else #sub_category_all @endif">{{(app()->getLocale() == 'ar')?$sub_category_1->name_ar:$sub_category_1->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent-1">
                                        <div class="tab-pane fade show active" id="sub_category_all" role="tabpanel">
                                            <div class="navs-footer">
                                                <hr>
                                            </div>
                                        </div>
                                        @foreach($category->children as $sub_category_1)
                                            @if(count($sub_category_1->children)>0)
                                                <div class="tab-pane fade" id="category_div_{{$sub_category_1->id}}" role="tabpanel">
                                                    <hr class="navs-hr">
                                                    <ul class="nav nav-pills mb-3" id="pills-tab-2" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="sub_sub_category_0" onclick="LoadAdvertisement({{$category->id}},{{$sub_category_1->id}})" data-toggle="pill" href="#sub_sub_category_all">{{__('web.Home.all_sub_categories')}}</a>
                                                        </li>
                                                        @foreach($sub_category_1->children as $sub_category_2)
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="category_{{$sub_category_2->id}}" onclick="LoadAdvertisement({{$category->id}},{{$sub_category_1->id}},{{$sub_category_2->id}})" data-toggle="pill" href="#category_div_{{$sub_category_2->id}}">{{(app()->getLocale() == 'ar')?$sub_category_2->name_ar:$sub_category_2->name}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="tab-content" id="pills-tabContent-2">
                                                        <div class="tab-pane fade show active" id="sub_sub_category_all" role="tabpanel">
                                                            <div class="navs-footer">
                                                                <hr>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12 all-media p-0" id="Advertisements">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-4" id="Paging">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
@section('script')
    <script>
        let page = 1;
        function LoadAdvertisement(category_id=null,sub_category_id=null,sub_sub_category_id=null){
            console.log('category_id : '+category_id);
            console.log('sub_category_id : '+sub_category_id);
            console.log('sub_sub_category_id : '+sub_sub_category_id);
            let data = {};
            if(category_id !==null){
                data['category_id'] = category_id;
            }
            if(sub_category_id !==null){
                data['sub_category_id'] = sub_category_id;
            }
            if(sub_sub_category_id !==null){
                data['sub_sub_category_id'] = sub_sub_category_id;
            }
            data['q'] = $('#q').val();
            data['page'] = page;
            $.get( "{{url('advertisements/response')}}",data,function( response ) {
                if (response.status.status === 'success'){
                    console.log(response);
                    let html = '';
                    let link = '';
                    $('#Advertisements').html('');
                    response.Advertisements.forEach(advertisement=>{
                        html=   '<div class="media">'+
                                '   <div class="row">'+
                                '       <div class="col-lg-2 col-2 p-0 d-flex"><img class="m-0 p-0" src="'+advertisement.FirstMedia.file+'" alt="..."></div>'+
                                '       <div class="col-lg-10 col-md-10 col-10">'+
                                '           <div class="row">'+
                                '               <div class="col-lg-9 col-md-8 col-9 p-0 media-body">'+
                                '                   <h5 class="mt-0">'+advertisement.title+'</h5>'+
                                // '                   <p class="m-0"> '+advertisement.content+' </p>'+
                                '               </div>'+
                                '               <div class="col-lg-3 col-md-4 col-3 p-0 d-flex">'+
                                '                   <div class="row">'+
                                '                       <div class="col-lg-12 m-b-m mob-bott"><button class="btn btn-add my-2 my-sm-0 mb-2 detail-btn" type="button" onclick="goAd('+advertisement.id+')">{{__('web.Home.details')}} </button></div>'+
                                '                       <div class="col-lg-12 m-b-m mob-bott"><button class="btn my-2 my-sm-0 adds-name detail-btn" type="button">'+advertisement.User.name+'</button></div>'+
                                '                   </div>'+
                                '               </div>'+
                                '           </div>' +
                                '           <div class="row resp-s">' +
                                '               <div class="col-lg-9 col-md-8 col-9 p-0">' +
                                '                   <div class="row b-top">'+
                                '                       <span class="col-lg-6 col-6 media-date">'+advertisement.City.name+' <i class="fas fa-map-marker-alt"></i></span>'+
                                '                       <span class="col-lg-6 col-5 media-date">'+advertisement.created_at+' <i class="far fa-clock"></i></span>'+
                                '                   </div>'+
                                '               </div>' +
                                '           <div class="col-lg-3 col-md-4 col-3 p-0 d-flex add-to-fav-pc">'+
                                '               <div class="col-lg-12 mob-bott pt-2 pb-2">';
                        if(advertisement.is_fav){
                            html +='<div class="text-center" id="ToggleFavPc-'+advertisement.id+'"><span class="add-to-fav" onclick="ToggleFav('+advertisement.id+')"> {{__('web.Home.remove_from_fav')}} <i class="fas fa-heart"></i></span></div>';
                        }else{
                            html +='<div class="text-center" id="ToggleFavPc-'+advertisement.id+'"><span class="add-to-fav color" onclick="ToggleFav('+advertisement.id+')"> {{__('web.Home.add_to_fav')}} <i class="far fa-heart"></i></span></div>';
                        }
                        html += '                 </div></div>' +
                                '                 <div class="col-lg-3 col-md-4 col-3 mob-bott add-to-fav-mob">';
                        if(advertisement.is_fav){
                            html +='                <div class="mob-bott"><div class="text-center" id="ToggleFavMob-'+advertisement.id+'"><span class="add-to-fav" onclick="ToggleFav('+advertisement.id+')"><i class="fas fa-heart"></i></span></div></div>';
                        }else{
                            html +='                <div class="mob-bott"><div class="text-center" id="ToggleFavMob-'+advertisement.id+'"><span class="add-to-fav color" onclick="ToggleFav('+advertisement.id+')"><i class="far fa-heart"></i></span></div></div>';
                        }
                        html += '                   </div>'+
                                '                </div>'+
                                '       </div>'+
                                '   </div>'+
                                '</div>';
                        $('#Advertisements').append(html);
                    });
                    if(response.paging.total > 0){
                        let paging = '';
                        let firstClass = '';
                        let lastClass = '';
                        let active = '';
                        let next;
                        let previous;
                        if (response.paging.current_page === 1) {
                            let firstClass = 'disabled';
                        }
                        if (response.paging.current_page === response.paging.last_page) {
                            let lastClass = 'disabled';
                        }
                        if(response.paging.current_page !== response.paging.last_page){
                            next = (response.paging.current_page+1);
                        }else {
                            next = response.paging.current_page;
                        }
                        if(response.paging.current_page !== 1){
                            previous = (response.paging.current_page-1);
                        }else {
                            previous = response.paging.current_page;
                        }
                        paging += '<ul class="pagination"><li class="page-item ' + firstClass + '">' +
                            '   <a class="page-link page-link--with-arrow" href="javascript:" data-id="1" aria-label="Previous">' +
                            '   <span class="page-link__arrow page-link__arrow--left" aria-hidden="true"><</span>' +
                            '   <span class="page-link__arrow page-link__arrow--left" aria-hidden="true"><</span>' +
                            '   </a>' +
                            '</li>';
                        paging += '<li class="page-item ' + firstClass + '">' +
                            '   <a class="page-link page-link--with-arrow" href="javascript:" data-id="'+previous+'" aria-label="Previous">' +
                            '   <span class="page-link__arrow page-link__arrow--left" aria-hidden="true"><</span>' +
                            '   </a>' +
                            '</li>';
                        if (response.paging.last_page > 6) {
                            if(response.paging.current_page < 4){
                                for (let i = 1; i <= 4; i++) {
                                    active = '';
                                    if (response.paging.current_page === i) {
                                        active = 'active';
                                    }
                                    paging += '<li class="page-item ' + active + '"><a class="page-link" href="javascript:" data-id="'+i+'">' + i + '</a></li>';
                                }
                                paging += '<li class="page-item page-item--dots">' +
                                    '   <div class="pagination__dots"></div>' +
                                    '</li>';
                                active = '';
                                if (response.paging.current_page === response.paging.last_page) {
                                    active = 'active';
                                }
                                paging += '<li class="page-item ' + active + '"><a class="page-link" href="javascript:" data-id="'+response.paging.last_page+'">' + response.paging.last_page + '</a></li>';

                            }else if(response.paging.current_page > (response.paging.last_page - 3)){
                                paging += '<li class="page-item"><a class="page-link" href="javascript:" data-id="1"> 1 </a></li>';
                                paging += '<li class="page-item page-item--dots">' +
                                    '   <div class="pagination__dots"></div>' +
                                    '</li>';

                                for (let i = 3; i >= 0; i--) {
                                    active = '';
                                    if (response.paging.current_page === (response.paging.last_page - i)) {
                                        active = 'active';
                                    }
                                    paging += '<li class="page-item ' + active + '"><a class="page-link" href="javascript:" data-id="'+(response.paging.last_page - i)+'">' + (response.paging.last_page - i) + '</a></li>';
                                }
                            }else{
                                paging += '<li class="page-item"><a class="page-link" href="javascript:" data-id="1"> 1 </a></li>';

                                paging += '<li class="page-item page-item--dots">' +
                                    '   <div class="pagination__dots"></div>' +
                                    '</li>';
                                paging += '<li class="page-item"><a class="page-link" href="javascript:" data-id="'+(response.paging.current_page-1)+'"> '+(response.paging.current_page-1)+' </a></li>';
                                paging += '<li class="page-item active"><a class="page-link" href="javascript:" data-id="'+response.paging.current_page+'"> '+response.paging.current_page+' </a></li>';
                                paging += '<li class="page-item"><a class="page-link" href="javascript:" data-id="'+(response.paging.current_page+1)+'"> '+(response.paging.current_page+1)+' </a></li>';
                                paging += '<li class="page-item page-item--dots">' +
                                    '   <div class="pagination__dots"></div>' +
                                    '</li>';
                                active = '';
                                paging += '<li class="page-item"><a class="page-link" href="javascript:" data-id="'+response.paging.last_page+'">' + response.paging.last_page + '</a></li>';
                            }
                        }
                        else {
                            for (let i = 1; i <= response.paging.last_page; i++) {
                                active = '';
                                if (response.paging.current_page === i) {
                                    active = 'active';
                                }
                                paging += '<li class="page-item ' + active + '"><a class="page-link" href="javascript:" data-id="'+i+'">' + i + '</a></li>';
                            }
                        }
                        paging += '<li class="page-item ' + lastClass + '">' +
                            '   <a class="page-link page-link--with-arrow" href="javascript:" data-id="'+next+'" aria-label="Next">' +
                            '   <span class="page-link__arrow page-link__arrow--right" aria-hidden="true">></span>' +
                            '   </a>' +
                            '</li>';
                        paging += '<li class="page-item ' + lastClass + '">' +
                            '   <a class="page-link page-link--with-arrow" href="javascript:" data-id="'+response.paging.last_page+'" aria-label="Next">' +
                            '   <span class="page-link__arrow page-link__arrow--right" aria-hidden="true">></span>' +
                            '   <span class="page-link__arrow page-link__arrow--right" aria-hidden="true">></span>' +
                            '   </a>' +
                            '</li></ul>';
                        $('#Paging').html(paging);

                    }
                }
            });
        }
        $(document).on('click', '.page-link', function () {
            page = $(this).data('id');
            LoadAdvertisement();
        });
        LoadAdvertisement();
        function goAd(id){
            window.location='{{url("advertisements/show?advertisement_id=")}}'+id;
        }
        function ToggleFav(id){
            $.post( "{{url('advertisements/response/toggle_fav')}}", {advertisement_id:id,_token:'{{csrf_token()}}'},function( response ) {
                if (response.status.status === 'success'){
                    if (response.data){
                        $('#ToggleFavPc-'+id).html('<span class="add-to-fav" onclick="ToggleFav('+id+')"> {{__('web.Home.remove_from_fav')}} <i class="fas fa-heart"></i></span>');
                        $('#ToggleFavMob-'+id).html('<span class="add-to-fav" onclick="ToggleFav('+id+')"><i class="fas fa-heart"></i></span>');
                    }else{
                        $('#ToggleFavPc-'+id).html('<span class="add-to-fav color" onclick="ToggleFav('+id+')"> {{__('web.Home.add_to_fav')}} <i class="far fa-heart"></i></span>');
                        $('#ToggleFavMob-'+id).html('<span class="add-to-fav color" onclick="ToggleFav('+id+')"><i class="far fa-heart"></i></span>');
                    }
                }
            });
        }
    </script>
@endsection
