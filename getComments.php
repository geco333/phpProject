<?php
    include_once('ConnectToDatabase.php');

    $query = $db->query("SELECT * FROM comments WHERE title='" . $_POST['title'] . "'");
    
    echo json_encode($query->fetchAll());
?>
