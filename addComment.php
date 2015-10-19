<?php
    session_start();
    include("carpoolingDAO.php");
    $commentText = $_POST["commentText"];
    $tripId = $_POST["tripId"];
    $userId = $_SESSION["userId"];
    addComment($commentText, $userId, $tripId)
?>

