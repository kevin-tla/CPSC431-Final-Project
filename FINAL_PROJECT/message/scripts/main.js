// AJAX for messaging

$(document).ready(function() {
    $('#sent').hide();
    $('#exactmsg').hide();
    $('#sentamount').hide();
    $('#inbox').show();
    $('#inboxamount').show();
});


$('#displaySentMail').on('click', function(event) {
    $('#inbox').hide();
    $('#exactmsg').hide();
    $('#inboxamount').hide();
    $('#sent').show();
    $('#sentamount').show();
});

$('#displayInbox').on('click', function(event) {
    $('#sentamount').hide();
    $('#exactmsg').hide();
    $('#sent').hide();
    $('#inbox').show();
    $('#inboxamount').show();

});

