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
        .page-link{
            color: #000;
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
    <div class="modal fade" id="SendMessage" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered">
            <form method="post" action="{{url('advertisements/send_message')}}" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{__('web.Advertisement.Show.message')}}</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="advertisement_id" id="advertisement_id" value="{{$Object->id}}">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="message" hidden></label>
                            <textarea class="form-control" id="message" name="message" required rows="5" placeholder="{{__('web.Advertisement.Show.message')}}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-lg delete-b">
                            <button class="btn btn-add my-2 my-sm-0 mb-2 detail-btn" type="submit">{{__('admin.Home.n_send')}} </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="ReportAbuse" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered">
            <form method="post" action="{{url('advertisements/report_abuse')}}" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{__('web.Advertisement.Show.report_abuse')}}</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="comment_id" id="comment_id">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="abuse_report_id">{{__('web.Advertisement.Show.abuse_type')}}</label>
                            <select name="abuse_report_id" id="abuse_report_id" class="form-control">
                                @foreach(\App\Models\AbuseReport::all() as $abuseReport)
                                    <option value="{{$abuseReport->getId()}}">{{app()->getLocale()=='ar'?$abuseReport->getNameAr():$abuseReport->getName()}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="details" hidden></label>
                            <textarea class="form-control" id="details" name="details" rows="5" placeholder="{{__('web.Advertisement.Show.details')}}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-lg delete-b">
                            <button class="btn btn-add my-2 my-sm-0 mb-2 detail-btn" type="submit">{{__('admin.Home.n_send')}} </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.Advertisement.show_advertisement')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="container-fluid single-post" style="min-height: 25vh">
        <div class="row">
            <div class="col-lg-8 order-sm-1 order-2">
                <div class="single-post-top">
                    <h4 class="@if(app()->getLocale() == 'ar') text-right @else text-left @endif">{{$Object->title}}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-lg-5 single-r-link">
                            <span class="media-date"><i class="fas fa-map-marker-alt"></i> {{$Object->City->name}}</span>
                            <span class="media-date"><i class="far fa-clock"></i> {{\Carbon\Carbon::parse($Object->created_at)->diffForHumans()}}</span>
                            <span id="ToggleFav-{{$Object->id}}" class="add-to-fav @if($Object->is_fav() != true) color @endif" onclick="ToggleFav({{$Object->id}})">
                                <i id="ToggleFavIcon-{{$Object->id}}" class="@if($Object->is_fav() != true) far @else fas @endif fa-heart"></i>
                                <span id="ToggleFavText-{{$Object->id}}">
                                    @if($Object->is_fav() != true)
                                        {{__('web.Advertisement.Show.add_to_favourite')}}
                                    @else
                                        {{__('web.Home.remove_from_fav')}}
                                    @endif
                                </span>
                            </span>
                        </div>
{{--                        <div class="col-lg-7 single-l-link">--}}
{{--                            <ul class="navbar-nav">--}}
{{--                                <li>--}}
{{--                                    <a class="" href="#"><i class="fab fa-twitter"></i></a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="" href="#"><i class="fab fa-instagram"></i></a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="" href="#"><i class="fab fa-facebook-square"></i></a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach($Object->Media as $media)
                            <div class="carousel-item @if($loop->index == 0) active @endif">
                                <img class="d-block w-100" src="{{asset($media->file)}}" alt="First slide">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    @if (count($Object->Media) > 1)
                        <ol class="carousel-indicators">
                            @foreach($Object->Media as $media)
                                <li data-target="#carousel-thumb" data-slide-to="{{$loop->index}}" @if($loop->index == 0) class="active" @endif>
                                    <img src="{{asset($media->file)}}" width="100" alt="">
                                </li>
                            @endforeach
                        </ol>
                    @endif
                </div>
                <div class="post-disc">{!! $Object->content !!}</div>
                <div class="row">
                    <div class="col-lg-12 p-0">
                        <div class="comments-area">
                            <h4>{{count($Object->Comments)}} {{__('web.Advertisement.Show.comments')}}</h4>
                            <hr>
                            <div id="Comments">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-4" id="Paging">
                            </div>
                        </div>
                        <div class="comment-form">
                            <h4> <i class="far fa-comment ml-2"></i> {{__('web.Advertisement.Show.leave_comment')}}</h4>
                            <form action="{{url('advertisements/comment')}}" method="post">
                                @csrf
                                <input type="hidden" name="advertisement_id" value="{{$Object->id}}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-10 p-0">
                                        <label for="comment"></label>
                                        <textarea id="comment" rows="5" required class="form-control" name="comment" placeholder="{{__('web.Advertisement.Show.leave_comment')}}"></textarea>
                                    </div>
                                </div><br />
                                <div class="form-group">
                                    <input type="submit" value="{{__('web.Advertisement.Show.add_comment')}}" class="btn py-2 col-4 submit-comment">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 order-1">
                <div class="card rate">
                    <div class="card-body">
                        <div>
                            <p class="card-title"><i class="fas fa-user-circle"></i>{{$Object->User->name}}</p>
{{--                            <form>--}}
{{--                                <fieldset>--}}
{{--                                    <span class="star-cb-group">--}}
{{--                                        <span class="rate-span">4.3</span>--}}
{{--                                        <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear" /><label for="rating-0">0</label>--}}
{{--                                        <input type="radio" id="rating-1" name="rating" value="1" /><label for="rating-1">1</label>--}}
{{--                                        <input type="radio" id="rating-2" name="rating" value="2" /><label for="rating-2">2</label>--}}
{{--                                        <input type="radio" id="rating-3" name="rating" value="3" /><label for="rating-3">3</label>--}}
{{--                                        <input type="radio" id="rating-4" name="rating" value="4" checked="checked" /><label for="rating-4">4</label>--}}
{{--                                        <input type="radio" id="rating-5" name="rating" value="5" /><label for="rating-5">5</label>--}}
{{--                                    </span>--}}
{{--                                </fieldset>--}}
{{--                            </form>--}}
                        </div>
                        @if(!$Object->hide_contact)
                            <p class="card-text"><i class="fas fa-mobile-alt"></i>{{$Object->contact}}</p>
                        @endif
                        @if($Object->price)
                            <p class="card-text"><i class="fas fa-tags"></i>{{$Object->price}}</p>
                        @endif
                        <a href="javascript:" class="btn submit-comment col-lg" data-toggle="modal" data-target="#SendMessage"><i class="far fa-comments"></i> {{__('web.Advertisement.Show.chat')}} </a>
                    </div>
                </div>
                <h5>{{__('web.Advertisement.Show.similar_advertisement')}}</h5>
                <hr>
                <div class="row other-ads">
                    <div class="col-lg-12 p-0">
                        @foreach($SimilarAd as $ad)
                        <div class="card another-ads"  style="max-width: 540px; ">
                            <div class="row no-gutters" style="cursor: pointer" onclick="window.location='{{url('advertisements/show?advertisement_id='.$ad->id)}}'">
                                <div class="col-md-3 chat-img">
                                    <img src="{{$ad->media()->first()->getFile()}}" class="card-img" alt="...">
                                </div>
                                <div class="col-lg-9">
                                    <div class="card-body chat-con">
                                        <div class="div card-h">
                                            <h5 class="card-title">{{$ad->title}}</h5>
                                        </div>
{{--                                        <p class="card-text">{{$ad->content}}</p>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg single-r-link">
                                    <span class="media-date"><i class="fas fa-map-marker-alt ml-2"></i> {{$ad->city->name}}</span>
                                    <span class="media-date"><i class="far fa-clock  ml-2"></i> {{\Carbon\Carbon::parse($ad->created_at)->diffForHumans()}}</span>
                                    <span id="ToggleFav-{{$ad->id}}" class="add-to-fav @if($ad->is_fav() != true) color @endif" onclick="ToggleFav({{$ad->id}})">
                                        <i id="ToggleFavIcon-{{$ad->id}}" class="@if($ad->is_fav() != true) far @else fas @endif fa-heart"></i>
                                        <span id="ToggleFavText-{{$ad->id}}">
                                            @if($ad->is_fav() != true)
                                                {{__('web.Advertisement.Show.add_to_favourite')}}
                                            @else
                                                {{__('web.Home.remove_from_fav')}}
                                            @endif
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <hr>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        function ToggleFav(id){
            $.post( "{{url('advertisements/response/toggle_fav')}}", {advertisement_id:id,_token:'{{csrf_token()}}'},function( response ) {
                if (response.status.status === 'success'){
                    if (response.data){
                        $('#ToggleFav-'+id).removeClass('color');
                        $('#ToggleFavIcon-'+id).removeClass('far').addClass('fas');
                        $('#ToggleFavText-'+id).html('{{__('web.Home.remove_from_fav')}}');
                    }else{
                        $('#ToggleFav-'+id).addClass('color');
                        $('#ToggleFavIcon-'+id).removeClass('fas').addClass('far');
                        $('#ToggleFavText-'+id).html('{{__('web.Home.add_to_fav')}}');
                    }
                }
            });
        }
    </script>
    <script>
        let page = 1;
        function LoadComments(){
            let data = {};
            data['page'] = page;
            data['advertisement_id'] = '{{$Object->id}}';
            $.get( "{{url('advertisements/comment/response')}}", data,function( response ) {
                if (response.status.status === 'success'){
                    let html = '';
                    let link = '';
                    $('#Comments').html('');
                    response.Comments.forEach(comment=>{
                        html =  '<div class="comment-list">'+
                        '   <div class="single-comment justify-content-between d-flex">'+
                        '       <div class="user justify-content-between d-flex">'+
                        '           <div class="desc">'+
                        '               <div class="comment-h">'+
                        '                   <a href="#">'+
                        '                       <h5>'+comment.User.name+'</h5>'+
                        '                   </a>'+
                        '                   <div class="reply-btn">'+
                        '                       <span class="date"><i class="far fa-clock mx-2"></i>'+comment.created_at+'</span>'+
                        '                   </div>' +
                        '                   <a href="javascript:" class="btn-reply" onclick="document.getElementById(`reply-comment-'+comment.id+'`).style.display = `block`">' +
                        '                       <i class="far fa-comment"></i>' +
                        '                       <span> {{__('web.Advertisement.Show.reply_comment')}} </span>' +
                        '                   </a>'+
                        '                   <a href="javascript:" class="btn-reply px-3" data-toggle="modal" data-target="#ReportAbuse" onclick="document.getElementById(`comment_id`).value=`'+comment.id+'`">' +
                        '                       <i class="fas fa-bug"></i>' +
                        '                       <span> {{__('web.Advertisement.Show.report_abuse')}}</span>' +
                        '                   </a>'+
                        '               </div>'+
                        '               <p class="comment">'+comment.comment+'</p>'+
                        '           </div>'+
                        '       </div>' +
                        '   </div>'+
                        '   <hr>'+
                        '   <div id="reply-comment-'+comment.id+'" class="row" style="display: none;">'+
                        '       <div class="form-group col-lg-12">'+
                        '           <label for="reply-'+comment.id+'" class="hidden"></label>'+
                        '           <input type="text" required="" name="reply" id="reply-'+comment.id+'" data-id="'+comment.id+'" value="" placeholder="" class="form-control reply-comment">'+
                        '       </div>'+
                        '   </div>'+
                        '</div>' +
                        '<div class="comment-list left-padding" id="Replies-'+comment.id+'">';
                        comment.Replies.forEach(reply =>{
                            html+=  '   <div class="single-comment justify-content-between d-flex">'+
                                    '    <div class="user justify-content-between d-flex">'+
                                    '        <div class="desc">'+
                                    '            <div class="comment-h">'+
                                    '                <a href="#">'+
                                    '                    <h5>'+reply.User.name+'</h5>'+
                                    '                </a>'+
                                    '                <div class="reply-btn">'+
                                    '                    <span class="date"><i class="far fa-clock mx-2"></i>'+reply.created_at+'</span>'+
                                    '                </div>' +
                                    '            </div>'+
                                    '            <p class="comment">'+reply.comment+'</p>'+
                                    '        </div>'+
                                    '    </div>' +
                                    '</div>'+
                                    '<hr>';
                        });
                        html+='</div>';
                        $('#Comments').append(html);
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
        LoadComments();
        $(document).on('click', '.page-link', function () {
            console.log(page);
            page = $(this).data('id');
            LoadComments();
        });
        $(document).on('keypress', '.reply-comment', function (e) {

            let keycode = (e.keyCode ? e.keyCode : e.which);
            let id = $(this).data('id');
            let content = $(this).val();
            console.log('keycode:'+keycode);
            console.log('content:'+content);
            console.log('id:'+id);
            if(keycode === 13 && content !== '') {
                let html = '';
                let data = {};
                data['_token'] = '{{csrf_token()}}';
                data['advertisement_id'] = '{{$Object->id}}';
                data['comment_id'] = id;
                data['comment'] = content;
                $.post( "{{url('advertisements/comment/post_response')}}", data,function( response ) {
                    if (response.status.status === 'success') {
                        html =  '<div class="single-comment justify-content-between d-flex">'+
                                '   <div class="user justify-content-between d-flex">'+
                                '       <div class="desc">'+
                                '           <div class="comment-h">'+
                                '               <a href="">'+
                                '                   <h5>'+response.Comment.User.name+'</h5>'+
                                '               </a>' +
                                '               <div class="reply-btn">'+
                                '                   <span class="date"> <i class="far fa-clock"></i> '+response.Comment.created_at+' </span>'+
                                '               </div>'+
                                '           </div>'+
                                '           <p class="comment">'+response.Comment.comment+'</p>'+
                                '       </div>'+
                                '   </div>'+
                                '</div>'+
                                '<hr>';
                        $('#Replies-'+id).append(html);
                        $(this).val('');
                    }
                });
            }
        });
    </script>
@endsection
