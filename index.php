<?php   
    session_start();

    require_once('ConnectToDatabase.php');

    if(!empty($_POST))
    {           
        $query = $db->prepare("SELECT * FROM users WHERE username='" . $_POST['username'] . "' AND password='" . $_POST['password'] . "'");
            
        $query->execute();
        
        if($query->rowCount() != 0)
        {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
            
            header("location: main.php");
        } // if
   } // if
?>


    <!doctype html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="login.css">

        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div id="banner">
            <img src="Movie.jpg">
        </div>

        <form class="" id='login_form' method="post" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input class="form-control" type="text" name="username" placeholder="Enter your username">
            </div>

            <div class="form-group">
                <label for="username">Password:</label>
                <input class="form-control" type="password" name="password" placeholder="Enter your password">
            </div>

            <input class="btn btn-primary" type="submit" value="Login">
            <a href="Register.php">
                <input class="btn btn-primary" type="button" value="Register">
            </a>
        </form>
    </body>

    </html>
