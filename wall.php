<?php
        session_start();
        include("carpoolingDAO.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="css/idangerous.swiper.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.min.css" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="img/favicon.ico" />
        <script src="js/jquery-2.1.3.min.js"></script>
         <script src="js/bootstrap.js"></script>
        <script src="js/idangerous.swiper.min.js"></script>
        <script src="js/isotope.pkgd.min.js"></script>
        <script src="js/global.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.min.js"></script>
        <script src="wall.js"></script>
        <title>Car Pooling</title>
    </head>
    <body class="header style-2 style-3 bg-2">

        <header>
            <div class="row">
                <div class="col-md-5"> </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-link hidden" id="newPost">New Post</button>
                </div>
                 <div class="col-md-5"> </div>
            </div>
            <div class="container">
                <div class="top-line">
                    <a class="logo" href="index.html">Car Pooling</a>
                    <button class="cmn-toggle-switch"><span></span></button>
                    
                </div>
                <a class="h-search">
                    <i class="fa fa-search"></i>
 
                </a>
                <div class="nav-container">
                    <nav class="main-nav">
                        <ul>

                        </ul>
                    </nav>
                    <button class="small-menu-btn"><span></span></button>
                    <nav class="sub-nav">
                        <ul>
                            <li><a href="about.html">About us</a></li>
                        </ul>
                    </nav>
                </div>

            </div>
        </header>
        <div id="content-wrapper">
            <div class="container">
                <div class="comment-form">
                    <div class="row">
                        <div class="col-md-2"> </div>
                        <div class="col-md-7">
                            <textarea id="postText" rows="1" style="width: 99%;"></textarea>
                        </div>
                        <div class="col-md-1">
                             <button class="btn-success btn-lg" id="addPost" style="height: 100%;">Add</button>
                        </div>
                         <div class="col-md-2"> </div>
                    </div>
                   
                   
                </div>

                <select name="selectedtrips" id="selectedtrips">      
                    <option value="latest">Latest Trips</option>
                    <option value="favorite">Favorite Trips</option>
                </select>
                <div class="content-wrapper-content big-block type-3" id="postList">
                    <?php
                        if (isset($_POST["newTrip"])) {
                            $result = searchNewestTripPost($_POST["newTrip"]);
                        }
                        else if(isset($_POST["favoriteTrip"])){
                            $result = searchFavoritedTripPost($_POST["favoriteTrip"]);
                        }
                        else if (isset($_POST["keyword"])) {
                            $result = searchTripPostByKeyword($_POST["keyword"]);
                        }
                        else {
                            $result = getAllTrips();
                        }
                        foreach($result as $trip) {
                    ?>
                    <div id="<?="trip_".$trip["trip_id"]?>" class="row">
                        <div class="col-md-8 col-md-push-2">
                            <div class="simple-article-block">
                                <div class="article-title">
                                    <div class="row">
                                        <span class="date pull-left"><?=$trip["username"]?></span>
                                        <span class="padding-side pull-left"><i class="fa fa-clock"><?=$trip["created_date"]?></i></span>
                                        <button class="dlt-btn padding-side pull-right" data-tripid="<?=$trip["trip_id"]?>"><i class="fa fa-times"></i></button>
                                        <button id="<?="edtTrip_".$trip["trip_id"]?>" class="padding-side pull-right" data-toggle="modal" data-target="<?='#edtTripModal_'.$trip["trip_id"]?>"><i class="fa fa-edit"></i></button>
                                        <button class="fav-btn padding-side pull-right" data-tripid="<?=$trip["trip_id"]?>"><i class="fa fa-heart-o"></i></button>
                                    </div>
                                    <h2 id="<?='tripText_'.$trip["trip_id"]?>" class="title">
                                        <?=$trip["trip_text"]?>
                                    </h2>
                                </div>

                                <div id="<?='edtTripModal_'.$trip["trip_id"]?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Edit</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="comment-form">
                                                <textarea style=" height: 100%;width: 100%;" id="<?="edtTripText_".$trip["trip_id"]?>"><?=$trip["trip_text"]?></textarea>
                                            </div></div>
                                            <div class="modal-footer">
                                                <button id="<?='clsbtn_'.$trip["trip_id"]?>" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button data-tripid="<?=$trip["trip_id"]?>" type="button" class="updt-btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="comments-block">
                                    <div class="row">
                                        <div class="col-md-2"> </div>
                                        <div class="col-md-8 comment-form">
                                            <textarea class="new-comment" data-tripid="<?=$trip["trip_id"]?>"  style="width: 99%;" rows="1"></textarea>
                                        </div>
                                         <div class="col-md-2"> </div>
                                    </div>
                                    <?php
                                        $comments = getCommentsByTrip($trip["trip_id"]);
                                        foreach($comments  as $comment){
                                    ?>
                                    <div id="<?="Comment_".$comment["comment_id"]?>"  class="comment">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="#" class="author">
                                                    <?=$comment["username"]?>
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="#" class="padding-side pull-right"><?=$comment["created_date"]?></a>
                                            </div>
                                            <div class="col-md-3">
                                                <div style="padding-right:20px;">
                                                    <button data-commentid="<?=$comment["comment_id"]?>" class="dlt-comm padding-side pull-right"><i class="fa fa-times"></i></button>
                                                    <button class="padding-side pull-right" data-toggle="modal" data-target="<?='#edtCommentModal_'.$comment["comment_id"]?>"><i class="fa fa-edit"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <p id="<?="CommentText_".$comment["comment_id"]?>" class="text">
                                                <?=$comment["comment_text"]?>
                                            </p>
                                        </div>
                                    </div>
                                    <div id="<?='edtCommentModal_'.$comment["comment_id"]?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Edit</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="comment-form">
                                                <textarea style=" height: 100%;width: 100%;" id="<?="edtCommentText_".$comment["comment_id"]?>"><?=$comment["comment_text"]?></textarea>
                                            </div></div>
                                            <div class="modal-footer">
                                                <button id="<?='clscomm_'.$comment["comment_id"]?>" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button data-commentid="<?=$comment["comment_id"]?>" type="button" class="updt-comm btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <?php } ?>
                                </div>
                            </div>
                              </div>
                            <div class="col-sm-6 col-md-2 col-md-pull-8">
                            </div>
                            <div class="col-sm-6 col-md-2">
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="search-popup popup search-block">
                <div class="title">Type the keyword</div>
                <form action="wall.php" method="POST">
                    <input type="text" placeholder="Search.." required="" name="keyword">
                    <div class="h-search">
                        <i class="fa fa-search"></i>
                        <input type="submit">
                    </div>
                </form>
                <button class="close"><i class="fa fa-times"></i></button>
            </div>
            <div class="popup-bg popup"></div>

    </body>
</html>
