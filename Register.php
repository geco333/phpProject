<?php
    require_once('ConnectToDatabase.php');
    
    $bool_account_created = 0;

    /* If username does not exists in database create 
        a new username and password. */
    if(!empty($_POST))
    {
        $bool_user_exists = $db->query("SELECT * FROM users WHERE username='" . $_POST['username'] . "'")->rowCount();        
        
        if($bool_user_exists == 0)
        {
            $bool_user_ = $db->query("INSERT INTO users (username, password) VALUES ('" . $_POST['username'] . "','" . $_POST['password'] . "')");
            
            $bool_account_created = 1;
            
            echo $bool_account_created;
        }
    } // if
?>


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

        <form class="" id='create_new_user_form' method="post" action="">
            <h5>Create new user account:</h5>

            <?php
                if(!empty($_POST) and $bool_user_exists != 0)
                {
                    echo "<h6>User name already in use, please select another.</h6>";
                } // if
            ?>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input class="form-control" type="text" name="username" placeholder="Enter your username">
                </div>

                <div class="form-group">
                    <label for="username">Password:</label>
                    <input class="form-control" type="password" name="password" placeholder="Enter your password">
                </div>

                <input class="btn btn-primary" type="submit" value="Create Account">
                <a href="Login.php">
                    <input class="btn btn-primary" type="button" value="Cancel">
                </a>

                <?php
                if($bool_account_created == 1)
                {
                    echo "<h6>Account created successfully.</h6>";
                } // if
            ?>
        </form>
    </body>

    </html>
