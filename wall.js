"use strict";
$(function () {
    $('#addPost').click(function addTrip(evt) {
        evt.preventDefault();
        var postText = $("#postText").val();
        $.post('addTrip.php', { postText: postText })
    .done(onSuccess)
    .fail(onError);
    });

    $(".dlt-btn").click(function () {
        var that = this;
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this trip!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function () {
            $.ajax({
                url: "deleteTrip.php",
                type: "POST",
                data: { tripId: $(that).attr("data-tripid") }
            }).done(function () {
                $("#trip_" + $(that).attr("data-tripid")).remove();
                swal("Deleted!", "Your trip has been deleted.", "success");
            })
        });
    });

    $(".dlt-comm").click(function () {
        var that = this;
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Comment!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function () {
            $.ajax({
                url: "deleteComment.php",
                type: "POST",
                data: { commentId: $(that).attr("data-commentid") }
            }).done(function () {
                $("#Comment_" + $(that).attr("data-commentid")).remove();
                swal("Deleted!", "Your comment has been deleted.", "success");
            })
        });
    });

    $(".fav-btn").click(function () {
        var that = this;
        $.ajax({
            url: "favTrip.php",
            type: "POST",
            data: { tripId: $(that).attr("data-tripid") }
        }).done(function () {

        })
    });

    $(".updt-btn").click(function () {
        var that = this;
        var tripId = $(that).attr("data-tripid");
        $.ajax({
            url: "updateTrip.php",
            type: "POST",
            data: {
                tripId: tripId,
                tripText: $("#edtTripText_" + tripId).val()
            }
        }).done(function () {
            $("#tripText_" + tripId).text($("#edtTripText_" + tripId).val());
            $("#edtTripText_" + tripId).val('');
            $("#clsbtn_" + tripId).click();
        })
    });
    $('.new-comment').keyup(function (e) {
        var that = this;
        var text = $(that).val().replace("\n","");
        alert(text);
        if (e.keyCode == '13' && text){
            var tripid = $(that).attr("data-tripid");
            var commentText = $(that).val();
            $.ajax({
                url: "addComment.php",
                type: "POST",
                data: {
                    tripId: tripid,
                    commentText: commentText
                }
            }).done(function () {
                $(that).val('');
                onSuccess();
            });
        }
        return false;
    });

    $(".updt-comm").click(function () {
        var that = this;
        var commentid = $(that).attr("data-commentid");
        $.ajax({
            url: "updateComment.php",
            type: "POST",
            data: {
                commentId: commentid,
                commentText: $("#edtCommentText_" + commentid).val()
            }
        }).done(function () {
            $("#CommentText_" + commentid).html($("#edtCommentText_" + commentid).val());
            $("#edtCommentText_" + commentid).val('');
            $("#clscomm_" + commentid).click();
        })
    });
});

function onSuccess() {
    swal("Added successfully!");
}
function onError() {
    swal("Error in adding trip!");
}



