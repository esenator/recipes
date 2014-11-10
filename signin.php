<?php     
    if (!defined('SID')) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
    
    <head>
        <!-- Latest compiled and minified CSS -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">-->
            
        <!-- Optional theme -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">-->
                
        <!-- Latest compiled and minified JavaScript 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
        
        <title>Recipes</title>
        
        <!-- Custom styles for this template -->
        <link href="css/stylesheet.css" rel="stylesheet">
        <link href="css/yeti.css" rel="stylesheet">
        
    </head>

  <body>

      <body>
        <nav class="navbar navbar-default" role="navigation" id="myTab">

            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" data-toggle="tab">Recipes <span class="label label-default">Beta</span></a>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#home" data-toggle="tab" id="home_tab">Home</a></li>
                        <li><a href="#about" data-toggle="tab">About</a></li>
                        <li><a href="#contact" data-toggle="tab">Contact</a></li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                                </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li><button type="button" class="btn btn-default navbar-btn" id="sign-in">Sign in</button></li>
                        <li class="dropdown">
                            <a href="#profile" class="dropdown-toggle" data-toggle="dropdown">Profile<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#prof_view">Go to Profile</a></li>
                                <li><a href="#prof_edit">Edit Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="signin">Sign in</a></li>
                                <li><a href="#logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
      
      
    <div class="container">
        <?php if (!empty($_SESSION["login_failure"])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php
                echo $_SESSION["login_failure"];
                unset($_SESSION["login_failure"]);
            ?>
        </div>
        <?php } ?>
      <form class="form-signin" role="form" action="checklogin.php" method="post">
        <h2 class="form-signin-heading">Sign in</h2>
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>