<?php
    session_start();
    include("carpoolingDAO.php");
    $postText = $_POST["postText"];
    if (strlen($postText) > 0) {
    $userId = $_SESSION["userId"];
    $trip= addTripPost($postText, $userId);
    $html = "<div id=\"trip_".$trip["trip_id"]."\" class = \"row\" >
        <div class=\"col-md-8 col-md-push-2\">
            <div class=\"simple-article-block\">
                <div class=\"article-title\">
                    <div class=\"row\">
                        <span class=\"date pull-left\">".$trip["username"]."</span>
                        <span class=\"padding-side pull-left\"><i class=\"fa fa-clock\">".$trip["created_date"]."</i></span>
                        <button class=\"dlt-btn padding-side pull-right\" data-tripid=\"".$trip["trip_id"]."\"><i class=\"fa fa-times\"></i></button>
                        <button id=\"edtTrip_".$trip["trip_id"]."\" class=\"padding-side pull-right\" data-toggle=\"modal\" data-target=\"#edtTripModal_".$trip["trip_id"]."\"><i class=\"fa fa-edit\"></i></button>
                        <button class=\"fav-btn padding-side pull-right\" data-tripid=\"".$trip["trip_id"]."\"><i class=\"fa fa-heart-o\"></i></button>
                    </div>
                    <h2 id=\"tripText_".$trip["trip_id"]."\" class=\"title\">
                        ".$trip["trip_text"]."
                    </h2>
                </div>

                <div id=\"edtTripModal_".$trip["trip_id"]."\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"mySmallModalLabel\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <h4 class=\"modal-title\" id=\"myModalLabel\">Edit</h4>
                            </div>
                            <div class=\"modal-body\">
                                <div class=\"comment-form\">
                                <textarea style=\" height: 100%;width: 100%;\" id=\"edtTripText_".$trip["trip_id"]."\">".$trip["trip_text"]."</textarea>
                            </div></div>
                            <div class=\"modal-footer\">
                                <button id=\"clsbtn_".$trip["trip_id"]."\" type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                                <button data-tripid=\"".$trip["trip_id"]."\" type=\"button\" class=\"updt-btn btn-primary\">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"comments-block\">
                    <div class=\"row\">
                        <div class=\"col-md-2\"> </div>
                        <div class=\"col-md-8 comment-form\">
                            <textarea class=\"new-comment\" data-tripid=\"".$trip["trip_id"]."\"  style=\"width: 99%;\" rows=\"1\"></textarea>
                        </div>
                         <div class=\"col-md-2\"> </div>
                    </div>";
                        $comments = getCommentsByTrip($trip["trip_id"]);
                        foreach($comments  as $comment){
                    $html =$html."
                    <div id=\"Comment_".$comment["comment_id"]."\"  class=\"comment\">
                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <a href=\"#\" class=\"author\">"
                                    .$comment["username"]."
                                </a>
                            </div>
                            <div class=\"col-md-3\">
                                <a href=\"#\" class=\"padding-side pull-right\">".$comment["created_date"]."</a>
                            </div>
                            <div class=\"col-md-3\">
                                <div style=\"padding-right:20px;\">
                                    <button data-commentid=\"".$comment["comment_id"]."\" class=\"dlt-comm padding-side pull-right\"><i class=\"fa fa-times\"></i></button>
                                    <button class=\"padding-side pull-right\" data-toggle=\"modal\" data-target=\"#edtCommentModal_".$comment["comment_id"]."\"><i class=\"fa fa-edit\"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class=\"content\">
                            <p id=\"CommentText_".$comment["comment_id"]."\" class=\"text\">"
                                .$comment["comment_text"]."
                            </p>
                        </div>
                    </div>
                    <div id=\"edtCommentModal_".$comment["comment_id"]."\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"mySmallModalLabel\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                                <h4 class=\"modal-title\" id=\"myModalLabel\">Edit</h4>
                            </div>
                            <div class=\"modal-body\">
                                <div class=\"comment-form\">
                                <textarea style=\" height: 100%;width: 100%;\" id=\"edtCommentText_".$comment["comment_id"]."\">".$comment["comment_text"]."</textarea>
                            </div></div>
                            <div class=\"modal-footer\">
                                <button id=\"clscomm_".$comment["comment_id"]."\" type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                                <button data-commentid=\"".$comment["comment_id"]."\" type=\"button\" class=\"updt-comm btn-primary\">Save</button>
                            </div>
                        </div>
                    </div>
                </div>";
                        }
    $html = $html."
                </div>
            </div>
              </div>
            <div class=\"col-sm-6 col-md-2 col-md-pull-8\">
            </div>
            <div class=\"col-sm-6 col-md-2\">
            </div>
        </div>";
    echo $html;
    }
?>

