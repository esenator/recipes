<?php
    if(!isset($_COOKIE['userlogin']))
    {
        header("location:index.html");
    }
    else
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Profile</title>
        <link rel="shortcut icon" href="">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    </head>
    
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Recipes</a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href=contact.html>Contact</a></li>
                    </ul>
                </div><!--.nav-collapse -->
            </div>
        </nav>
        
        <?php if (!empty($_SESSION["login_failure"])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php
                echo $_SESSION["login_failure"];
                unset($_SESSION["login_failure"]);
            ?>
        </div>
        <?php } ?>
        
        <div class="jumbotron">
            <p>
            <?php 
                echo "Welcome back to the site " . $_COOKIE['userlogin'] ;
            ?>
            </p>
            <p><a href="logout.php">Click here to clear cookies and logout.</a></p>
        </div>
        
        <div class="container">
            <form class="form-signin" role="form" action="update_user.php" method="post">
        <h2 class="form-signin-heading">Update info</h2>
        <input type="text" name="firstname" class="form-control" placeholder="First Name" autofocus>
        <input type="text" name="lastname" class="form-control" placeholder="Last Name">
        <input type="email" name="email" class="form-control" placeholder="Email address">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </form>
        </div>
        
    </body>
</html>