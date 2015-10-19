<?php
    session_start();
    include("carpoolingDAO.php");
    $postText = $_POST["postText"];
    $userId = $_SESSION["userId"];
    addTripPost($postText, $userId);
?>

