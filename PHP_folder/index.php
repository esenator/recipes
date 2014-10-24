<?php 
    if(!defined('SID')) {
        session_start();
    }
    $_SESSION['signed_in'] = 'false';
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
        <link href="../css/stylesheet.css" rel="stylesheet">
        <link href="../css/yeti.css" rel="stylesheet">
        
    </head>
    
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
                        <li class="dropdown">
                            <a href="#profile" class="dropdown-toggle" data-toggle="dropdown">Profile<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#prof_view">Go to Profile</a></li>
                                <li><a href="#prof_edit">Edit Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="../signup.php">Sign up</a></li>
                                <?php if ($_SESSION['signed_in'] == 'false') { 
        echo "not signed in"; ?>
                                    <li><a href="../signin.php">Sign in</a></li>
                                <?php } else { echo "signed in" ; ?>
                                    <li  class="disabled"><a href="../signup.php">Sign up</a></li> 
                                <?php } ?>
                                <?php if ($_SESSION['signed_in'] == 'false') { ?>
                                    <li  class="disabled"><a href="#logout">Logout</a></li>
                                <?php } else { ?>
                                    <li><a href="#logout">Logout</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="tab-content">
            <div class="tab-pane active" id="home"></div>
            <div class="tab-pane" id="contact"></div>
            <div class="tab-pane" id="about"></div>
            <div class="tab-pane" id="prof_view"></div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <script>
            $('#home').load('../tab_pages/main.html');
            $('#about').load('../tab_pages/about.html');
            $('#contact').load('../tab_pages/contact.html');
            
            $('#signin').load('../signin.php');
        </script>

    </body>

</html>