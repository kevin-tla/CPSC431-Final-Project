$('#add').on('click', function() {
    var chatroomName = $('#chatroomName').val();
    console.log('get chatroom Name', chatroomName);
    var user = $('#username').text();
    if(user == 'Anonymous'){
        alert('You can create the '+chatroomName+' chatroom after you log in!');
        window.location = '../forum/login_page.php';
    }else{
        if(chatroomName == ''){
            alert("Chatroom Name cannot be Empty");
        }else if(checkRoom(chatroomName)){
            alert("Room Exist");
        }else{
            $.post('chatlist.php', {
                'content': chatroomName,
            }, function(result){
                //console.log(result.content);
                createChatroom(result.RoomId, chatroomName, result.startUser);
           });
       }
    }

});


/*
promise
var p2 = new Promise(function(resolve, reject) {
  resolve(1);
});

p2.then(function(value) {
  console.log(value); // 1
  return value + 1;
}).then(function(value) {
  console.log(value + '- This synchronous usage is virtually pointless'); // 2- This synchronous usage is virtually pointless
});

p2.then(function(value) {
  console.log(value); // 1
});

*/

var checkRoom = function(roomList){
    var roomIdList = $('.ChatRoom');
    for(var i = 0; i<roomIdList.length; i++){
        if(roomIdList[i].innerHTML.toUpperCase() === roomList.toUpperCase()){
            return true;
        };
    }
}


var createChatroom = function(RoomId, chatroomName, startUser){
    var chatroom = $('<tr></tr>').attr({
        'class': 'chartoomRow'
    });
    var id = $('<td></td>').text(RoomId);
    var chatroom_Name = $('<td></td>').text(chatroomName);
    var start_user = $('<td>'+ startUser + '</td>');
    var join = $('<td></td>');
    var join_button=$('<button></button>').attr({
        'class': 'join',
        'id': RoomId,
        value: chatroomName
    });
    //var delete_button=$('<button></button>').attr
    join_button.text('Join');
    join.append(join_button);
    chatroom.append(id);
    chatroom.append(chatroom_Name);
    chatroom.append(start_user);
    chatroom.append(join);
    $('.chatlist').append(chatroom);
}

$('.chatlist').on('click', '.join', function(e){
    e.preventDefault();
    var roomid = this.id;
    var roomcontent = this.value;
    var user = $('#username').text();
    if(user == 'Anonymous'){
        alert('You can join the chatroom after you log in!');
        window.location = '../forum/login_page.php';
    }else{
        $.post('join.php', {
            'RoomNo': roomid,
            'Content': roomcontent
        }, function(result){
            window.location ='./chatroom.php';
       });
    }

});


var getChatRoomList = function(){
    $.get('getChatList.php', function(result){

        $.each(result, function(index, obj){
            createChatroom(obj.RoomNo, obj.Content, obj.StartUser);
        })
    });
}

getChatRoomList();
