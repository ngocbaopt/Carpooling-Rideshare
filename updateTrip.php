<?php
    session_start();
    include("carpoolingDAO.php");
    $tripText = $_POST["tripText"];
    $tripId = $_POST["tripId"];
    updateTripPost($tripId, $tripText);
?>

