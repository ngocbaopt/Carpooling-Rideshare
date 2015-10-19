<?php
    session_start();
    include("carpoolingDAO.php");
    $commentId = $_POST["commentId"];
    deleteComment($commentId);
?>

