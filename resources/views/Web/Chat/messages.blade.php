<div class="col-12 col-lg-9 chat-l">
    <div class="w3-container city" style="display:block">
        <div class="header-chat row">
            <div class="col-lg-5 col-7 pr-0">
                <div class="row">
                    <div class="back col-lg col-2 ">
                        <button type="button" class="btn"> <i class="fas fa-angle-right"></i></button>
                    </div>
                    <div class="col-lg-2 col-3 chat-img">
{{--                        <img src="lib/img/Avatar.png" class="card-img " alt="...">--}}
                    </div>
                    <div class="col-lg-10 col-7 img-name">
                        <p id="ChatUserName"></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-5 chat-remove">
                <button type="button" class="btn btn-danger"> <i class="far fa-trash-alt ml-2"></i> حذف المحادثة </button>
            </div>
        </div>
        <hr>
        <div class="row chat-body" id="ChatMessagesBox">
            <div class="col-12 pl-0 pr-0">
                <div class="main-chat" id="ChatMessages">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 send-chat">
                <div class="row">
                    <div class="form-group col-md-11 col-10 chat-input">
                        <label for="message"></label>
                        <textarea class="form-control" name="message" id="message" rows="3" placeholder="{{__('web.Advertisement.Show.message')}}"></textarea>
                    </div>
                    <div class="col-md-1 col-2 chat-button">
                        <button class="btn btn-add my-2 my-sm-0 mb-2 detail-btn" onclick="SendMessage()" type="button"><i class="fas fa-paper-plane"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
