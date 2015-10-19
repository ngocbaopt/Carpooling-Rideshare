<?php
    session_start();
    include("carpoolingDAO.php");
    
    $tripId = $_POST["tripId"];
    $userid = $_SESSION["userId"];
    addFavorite( $userid, $tripId);
?>

