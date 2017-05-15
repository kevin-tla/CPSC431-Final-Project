var previousId;
var lastMessageId;
var firstPoll = function() {
    //console.log('first', 'first');
    $.post('chat.php', {
        'firstpoll': 'first'
    }, function(result){
        //console.log(result);
        previousId = result.messages[0].id;
        $.each(result.messages, function(idx) {
            var chatBubble;
            chatBubble = $('<div>' +
                    this.sent_by+': '+
                    this.message +
                    '</div><div class="clearfix"></div>');
            $('#chatPanel').prepend(chatBubble);
            $('#chatPanel')[0].scrollIntoView();
        });
        $('#chatPanel').append("<div><b>-------Chat History End, Send Your Message-------</b></div>");
    });
}


//console.log($.get);
var pollServer = function() {
    $.get('chat.php', function(result) {
        //console.log(result);
        console.log(result.statement);
        if(result.messages.length){
            console.log(result.messages);
        }
        if (!result.success) {
            console.log("Error polling server for new messages!");
            return;
        }

        $.each(result.messages, function(idx) {
            if(this.id != previousId){
                // /console.log(previousId);
                var chatBubble = $('<div>' +
                        this.sent_by+': '+
                        this.message +
                        '</div><div class="clearfix"></div>');
                $('#chatPanel').append(chatBubble);
                lastMessageId = this.id;
            }
        });
        previousId = lastMessageId;

        setTimeout(pollServer, 2000);

    });
}


$(document).on('ready', function() {
    firstPoll();
    pollServer();
    $('button').click(function() {
        $(this).toggleClass('active');
    });
});




$('#sendMessageBtn').on('click', function(event) {
    event.preventDefault();
    var message = $('#chatMessage').val();
    var user = $('#username').text();
    if(user == 'Anonymous'){
        alert('You can join the chatroom after you log in!');
        window.location = '../forum/login_page.php';
    }else{
        $.post('chat.php', {
                'message': message,
                'user': user
            }, function(result) {
                //console.log(result);
                $('#sendMessageBtn').toggleClass('active');
                if (!result.success) {
                    alert("There was an error sending your message");
                }else {
                console.log("Message sent!");
                $('#chatMessage').val('');
            }
        });
    }


});

$('#chatMessage').keypress(function( event ) {
      if ( event.which == 13 ) {
         event.preventDefault();
         $('#sendMessageBtn').click();
      }
  });
