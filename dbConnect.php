<?php
    $db = new PDO("mysql:dbname=carpoolingapp;host=localhost","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>