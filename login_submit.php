<?php
    session_start();
    include("dbConnect.php");
    $name = $_POST["username"];
    $pass = $_POST["password"];
    $remember = $_POST["remember"];
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :name");
    $stmt -> bindparam(':name', $name);
    $stmt -> execute();
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    if(password_verify($pass, $result[0]["password"])){
        $time = time() + 86400;
        if(isset($remember)){
            if(!isset($_COOKIES["userauth"])){
                setcookie("userauth", $name, $time);
            }else{
                $_SESSSION["username"] = $_COOKIE["userauth"];
            }
            //$_SESSSION["username"] = $result["username"];
            echo 'Welcome!!';
        }else{
            echo 'Welcome session not set';
        }
        header('location: wall.php');
    }else {
        $_SESSION["loginError"] = 'Invalid username or password! Please try again.';
        header('location: login.php');
    }
?>