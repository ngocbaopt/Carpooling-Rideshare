<?php
    global $db;
    $db = new PDO("mysql:dbname=carpoolingapp;host=localhost", "root", "");
//    $db = new PDO("mysql:dbname=carpoolingapp;host=localhost", "ProEngOctober", "CSMaster");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
