<?php session_start() ?>
<!DOCTYPE html>
<html>
	<head>
        <title>Car Pooling Application</title>
        <meta charset="utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link href="css/signin.css" type="text/css" rel="stylesheet"/>
	</head>
	<body>  
        <div class="container">            
          <form class="form-signin" method="POST" action="login_submit.php">
            <?php if(isset($_SESSION["loginError"])){
            ?>
                <p class="text-danger"> <?= $_SESSION["loginError"] ?> </p>
            <?php
                $_SESSION["loginError"] = null;
            } 

            if(isset($_SESSION["register"])){
            ?>
                <p class="text-danger"> <?= $_SESSION["register"] ?> </p>
            <?php 
                $_SESSION["register"] = null;
            }
            ?>
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputname" class="sr-only">Username</label>
            <input type="text" id="inputname" class="form-control" placeholder="Username" required autofocus name="username">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember[]" id="remember" value="true"> Remember me
              </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <p class="text-info">Don't have the account? <a href="register.php">Sign up here</a></p>
      </form>
    </div>
	</body>
</html>