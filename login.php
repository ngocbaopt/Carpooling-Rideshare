<?php session_start() ?>
<!DOCTYPE html>
<html>
	<head>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <style>
            .center{
                position: fixed;
                top: 30%;
                
            }
        </style>
	</head>

	<body>
    
    <div class ="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
                <?php if(isset($_SESSION["loginError"])){
                echo $_SESSION["loginError"];
                $_SESSION["loginError"] = null;
            } 
            if(isset($_SESSION["register"])){
                echo $_SESSION["register"];
                $_SESSION["register"] = null;
            }
            ?>
            </div>
        <div class="col-md-4"></div>
        </div>
	<div class="row" >
        <div class="col-md-4">
        
        </div>
        <div class="col-md-4">
            
        
        <form class="form-horizontal, center" action="login_submit.php" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputname" placeholder="Name" name="username">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember[]" id="remember" value="true"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-s7c">Sign in</button>
        <h6>Don't have an account?</h6>
        <a href="register.php">Sign Up Here!</a>
    </div>
  </div>
</form></div>
        <div class="col-md-4"></div>
        
        
        </div>
	</body>
</html>