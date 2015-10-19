<?php
    session_start();
    include("carpoolingDAO.php");
    $tripId = $_POST["tripId"];
    deleteTripPost($tripId);
?>

