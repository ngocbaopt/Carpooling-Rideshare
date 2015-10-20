<?php 
    session_start();
    include("db-connection.php");
    $password = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    try{
        $stmt = $db->prepare("INSERT INTO users VALUES (NULL, :name, :password, :email, NOW())");
        $db->beginTransaction();
        $stmt->execute(array(':name'=>$_POST["uname"],
                             ':password'=>$password,
                             ':email'=>$_POST["email"])); 
        $newid = $db->lastInsertId();
        $db->commit();
        $_SESSION["register"] = "Sign up successful! Login now.";
        header('location: login.php');
    }
    catch(PDOException $e){
        print $e->getMessage();
    }
?>