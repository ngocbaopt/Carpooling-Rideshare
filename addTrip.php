<?php
    session_start();
    include("carpoolingDAO.php");
    $postText = $_POST["postText"];
    $userid = $_SESSION["userId"];
    addTripPost($postText,$userid);
?>

