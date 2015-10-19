<?php
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
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="img/favicon.ico" />
         <script src="js/jquery-2.1.3.min.js"></script>
        <script src="js/idangerous.swiper.min.js"></script>
        <script src="js/isotope.pkgd.min.js"></script>
        <script src="js/global.js"></script>
        <title>Car Pooling</title>
    </head>
    <body class="header style-2 style-3 bg-2">
     
        <header>
            <div class="container">
                <div class="top-line">
                    <a class="logo" href="index.html">Car Pooling</a>
                    <button class="cmn-toggle-switch"><span></span></button>
                </div>
                <a class="h-search"><i class="fa fa-search"></i></a>
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
                <div>
                    <textarea id="postText" rows="5" style="width: 90%;"> </textarea>
                    <button id="addPost">Add Post</button>
                </div>
                <div class="content-wrapper-content big-block type-3">
                    <?php   $result = getAllTrips(1);
                            foreach($result as $trip) { ?>
                            <div class="row">
                            <div class="col-md-8 col-md-push-2">
                                <div class="simple-article-block">
                                    <div class="article-title">
                                        <div class="row">
                                            <span class="date pull-left"><?=$trip["username"]?></span>
                                            <a class="padding-side pull-left" href="#"><i class="fa fa-clock"><?=$trip["created_date"]?></i></a>
                                            <a class="padding-side pull-right" href="#"><i class="fa fa-times"></i></a>
                                            <a class="padding-side pull-right" href="#"><i class="fa fa-edit"></i></a>
                                            <a class="padding-side pull-right" href="#"><i class="fa fa-heart-o"></i></a>
                                        </div>
                                        <h2 class="title">
                                            <?=$trip["trip_text"]?>
                                        </h2>
                                    </div>
                                </div>
                                    <div class="comments-block">
                                        <?php
                                            $comments = getCommentsByTrip($trip["trip_id"]);
                                            foreach($comments  as $comment){ ?>
                                            <div class="comment">
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
                                                        <a href="#" class="padding-side pull-right"><i class="fa fa-times"></i></a>
                                                        <a href="#" class="padding-side pull-right"><i class="fa fa-edit"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <p class="text">
                                                    <?=$comment["comment_text"]?>
                                                </p>
                                            </div>
                                        </div>
                                         <?php } ?>
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
        <footer class="footer style-3">
            <div class="container">
                <div class="row">
                  
                </div>
            </div>
        </footer>
        <div class="search-popup popup search-block">
            <div class="title">Type the keyword</div>
            <form action="http://demo.nrgthemes.com/projects/nrgblog/">
                <input type="text" placeholder="Search.." required="">
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
