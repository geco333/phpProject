<?php
    if(isset($_POST))
    {   
        $db = new PDO('mysql:host=localhost;dbname=moviesdb;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES=> false, ]);
        
        $stmt_ratings = $db->query("DELETE FROM ratings WHERE title='" . $_POST[0] . "'");

        $stmt_main = $db->query("DELETE FROM maintable WHERE title='" . $_POST[0] . "'");
    }
?>
