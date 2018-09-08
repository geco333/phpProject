<?php
    session_start();

    $is_admin = false;

    if(empty($_SESSION))
        echo json_encode($is_admin);
    else
    {        
        if($_SESSION['username'] == 'admin' and                    $_SESSION['password'] = '31012310')
        {
            $is_admin = true;
            echo json_encode($is_admin);
        } // if
        
        else 
            echo json_encode($is_admin);
    } // else
?>
