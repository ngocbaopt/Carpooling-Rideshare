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
        <link href="css/signout.css" type="text/css" rel="stylesheet"/>
	</head>
        
	<body>
        <div class="container">            
          <form class="form-signout" method="POST" action="register_submit.php">
            <h2 class="form-signout-heading">Car Pooling Sign up</h2>
              
            <div class="form-group">
                <label class="control-label col-sm-2" for="name1">Username:</label>
                <div class="col-sm-10">          
                    <input type="text" class="form-control" id="name1" placeholder="Enter username" name="uname" required autofocus>
                </div>
            </div>              
              
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">          
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">          
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                </div>
            </div>              
              
            <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default btn-primary btn-lg">Sign up</button>
                </div>
            </div>
        </form>
        </div>
	</body>
</html>





