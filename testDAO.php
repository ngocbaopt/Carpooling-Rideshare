<?php
    include("carpoolingDAO.php");
?>
<!DOCYTYPE html>
<!--
This is used to test the functions of carpoolingDAO
WAP - October 2015
@author: Bao Pham
-->
<html>
    <head>
        <title>Test CarpoolingDAO</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="" method="POST">
            <input type="submit">Add Trip Post</button>
        </form>
        
<!--
        <button id="newtrippost">Add Trip Post</button>
        <button id="newcomment">Add Comment</button>
        <button id="deletetrippost">Delete Trip Post</button>
        <button id="deletecomment">Delete Comment</button>
        <button id="addfavorite">Add Favorite</button>
        <button id="removeFavorite">Remove Favorite</button>
        <button id="searchNewestTripPost">Search New Trip Post</button>
        <button id="searchFavoritedTripPost">Search Favorite Trip Post</button>
        <button id="searchTripPostByKeyword">Search Trip Post by Keyword</button>
        <button id="updateComment">Update Comment</button>
        <button id="updateTripPost">Update Trip Post</button>
-->
        <?php
                $triptext = "Hello. This is my updated comment";
//                $newid = addComment($triptext, 1, 1);
//                $newid = addTripPost($triptext, 1);
//                $newid = deleteTripPost(1);
//                $newid = deleteComment(1);
//                    $newid = addFavorite(4,2);
//                    $newid = addFavorite(5,2);
//                    $newid = removeFavorite(4,2);
//                    $data = searchNewestTripPost();
//                    $data = searchFavoritedTripPost();
                    $keyword = "my";
//                    $data = searchTripPostByKeyword($keyword);
//                    $data = updateComment(2, $triptext);
                    $data = updateTripPost(2, $triptext);
                    print_r($data);
    
        ?>
<!--                <p> <?= $newid ?> </p>
-->
<!--                    <p> <?= $data ?> </p>-->

    </body>
</html>
