<?php include("dbConnect.php") ?>
<P>Thank you for registering!!</P>
<?php
    session_start();
    $password = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    try{
        $stmt = $db->prepare("INSERT INTO users VALUES (NULL, :name, :password, :email, NOW())");
        $stmt->bindparam(':name', $_POST["uname"]);
        $stmt->bindparam(':password', $password);
        $stmt->bindparam(':email', $_POST["email"]);
        $stmt->execute();
    }
    catch(PDOException $e){
        echo "Error: ".$e->getMessage();
    }
    $_SESSION["register"] = "Sign up successful! Login now.";
    header('location: login.php');
?>