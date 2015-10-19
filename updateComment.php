<?php
    session_start();
    include("carpoolingDAO.php");
    $commentText = $_POST["commentText"];
    $commentId = $_POST["commentId"];
    updateComment($commentId, $commentText);
?>

