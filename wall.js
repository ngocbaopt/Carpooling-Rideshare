"use strict";
$(function () {
    $('#addPost').click(function addTrip(evt) {
        evt.preventDefault();
        var postText = $("#postText").val();
        $.post('addTrip.php', { postText: postText })
    .done(function(data) {
        $("#postText").val("");
        $("#postList").prepend(data);
        swal("Added successfully!");           
        })
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
    
    $("#selectedtrips").change(function () {
        var selectedtrip = $("#selectedtrips option:selected").val();
        $.ajax({
            url: "latestTrip.php",
            dataType: "html",
            type: "post",
            data: {
                selectedTrip: selectedtrip
            }
        }).done(function (data) {
        })
    });
    
    var newPost = "";
    var timeout = setInterval(function() {
            $.get("getNewTripPost.php").done(function(data) {
                if (data.length > 1) {
                    if ($("#newPost").hasClass("hidden")) {
                        $("#newPost").removeClass("hidden").addClass("show");
                    }
                    newPost = data;
                }
                else {
                    if ($("#newPost").hasClass("show")) {
                        $("#newPost").removeClass("show").addClass("hidden");
                    }
                }
            }).fail(onError);            
    }, 30000);
    
    $("#newPost").click(function() {
        $("#postList").empty();
        $("#postList").append(newPost);
        $(this).removeClass("show").addClass("hidden");
        newPost = "";
    });

});

function onSuccess() {
    swal("Added successfully!");

}
function onError() {
    swal("Error in adding trip!");
}



