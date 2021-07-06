@extends('Web.layouts.app')
@section('content')
    <section class="container-fluid bread-crumb">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('web.main_page')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('web.chats')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="chats container-fluid" style="min-height: 25vh">
        <div class="row">
            @include('Web.Chat.rooms')
            @include('Web.Chat.messages')
        </div>
    </section>
@endsection
@section('script')
    <script>
        let chat_room_id;
        let user_name;
    function LoadChatRoom(){
        let q = $('#rooms_search').val();
        $.get( "{{url('chat/rooms')}}",{q:q},function( response ) {
            if (response.status.status === 'success'){
                let i =0;
                $('#ChatRooms').html('');
                response.ChatRooms.forEach(room =>{
                    $('#ChatRoomUserName').html(room.User.name);
                    let ele = $('#ChatRoomDiv').clone().attr('id','ChatRoom-'+room.id).attr('data-id',room.id).attr('data-name',room.User.name);
                    $('#ChatRooms').append(ele.show());
                    OpenBroadcast(room.id);
                    if(i === 0){
                        GetMessages(ele);
                    }
                    i++;
                });
            }
        });
    }
    LoadChatRoom();
    $('#ChatRoomSearchForm').on('submit',function (e){
        e.preventDefault();
        LoadChatRoom();
    });
    function GetMessages(ChatRoom){
        chat_room_id = $(ChatRoom).data('id');
        user_name = $(ChatRoom).data('name');
        $('#ChatUserName').html(user_name);
        $.get( "{{url('chat/messages')}}",{chat_room_id:chat_room_id},function( response ) {
            if (response.status.status === 'success'){
                $('#ChatMessages').html('');
                response.ChatMessages.forEach(message =>{
                    if(message.is_mine){
                        $('#ChatMessages').append('<div class="float-r">'+
                                                    '<div class="me">'+
                                                        '<p>'+message.message+'</p>'+
                                                    '</div>'+
                                                    '<span>'+message.created_at+'</span>'+
                                                '</div>');
                    }else{
                        $('#ChatMessages').append('<div class="float-l">'+
                                                    '<div class="you">'+
                                                        '<p>'+message.message+'</p>'+
                                                    '</div>'+
                                                    '<span>'+message.created_at+'</span>'+
                                                '</div>');
                    }
                });
            }
        });

    }
    function SendMessage(){
        let message = $('#message').val();
        $.post( "{{url('chat/messages/send')}}",{message:message,chat_room_id:chat_room_id,_token:'{{csrf_token()}}'},function( response ) {
            if (response.status.status === 'success'){
                $('#ChatMessages').append('<div class="float-r">'+
                                            '<div class="me">'+
                                                '<p>'+response.ChatMessage.message+'</p>'+
                                            '</div>'+
                                            '<span>'+response.ChatMessage.created_at+'</span>'+
                                          '</div>');
                $('#message').val('');
                ScrollDown();
            }
        });
    }
    </script>
    <script>
        function ScrollDown(){
            $("#ChatMessagesBox").animate({ scrollTop: $('#ChatMessagesBox').prop("scrollHeight") })
        }
        function OpenBroadcast(id){
            window.Echo.channel('new_message.'+id)
                .listen('SendMessageEvent',e=>{
                    if(id === chat_room_id ){
                        $('#ChatMessages').append('<div class="float-l">'+
                            '<div class="you">'+
                            '<p>'+e.message.message+'</p>'+
                            '</div>'+
                            '<span>'+e.message.created_at+'</span>'+
                            '</div>');
                        ScrollDown();
                    }
                });
        }
    </script>
 @endsection
