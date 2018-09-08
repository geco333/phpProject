<?php
    if(isset($_GET))
    {                
        // Make PDO object.
        $db = new PDO('mysql:host=localhost;dbname=moviesdb;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES=> false, ]);

        // Check if title exists in database.
        $stmt = $db->query("SELECT * FROM maintable WHERE " . $_GET['key'] . " LIKE '" . $_GET['value'] . "%'");

        echo json_encode($stmt->fetchAll());
    } // if
?>
