"use strict";
$(function() {
   $('#addPost').click(addTrip);
});

function addTrip(evt) {
    evt.preventDefault();
    var postText = $("#postText").val();
    $.post('addTrip.php', {postText: postText}).done(onSuccess).fail(onError);
}

function onSuccess(data) {
    alert("Add successful");
}

function onError() {
    alert("Error in adding trip");
}