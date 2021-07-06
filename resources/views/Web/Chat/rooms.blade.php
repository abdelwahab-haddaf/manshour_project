<div class="col-lg-3 col-12 chat-r">
    <div class="w3-sidebar w3-bar-block">
        <div class="row mb-2">
            <form class="form-inline col-12" id="ChatRoomSearchForm">
                <input class="search form-control" id="rooms_search" name="rooms_search" type="search" placeholder="{{__('admin.search')}}" aria-label="Search">
                <button class="btn btn-gradient my-2 my-sm-0" type="button" onclick="LoadChatRoom()"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="scroll w-100" id="ChatRooms">
        </div>
    </div>
</div>
<button class="w3-bar-item w3-button" id="ChatRoomDiv" onclick="GetMessages(this)" style="display:none;">
    <div class="row">
        <div class="col-12 p-0">
            <div class="card px-3">
                <div class="row no-gutters">
                    <div class="col-12">
                        <div class="card-body chat-con">
                            <div class="div card-h">
                                <h5 class="card-title" id="ChatRoomUserName"></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</button>
