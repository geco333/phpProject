<?php
    include_once('ConnectToDatabase.php');
    
    $db->query("DELETE FROM comments WHERE cid = " . $_POST['cid']);
?>
