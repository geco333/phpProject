<?php
    include_once('ConnectToDatabase.php');


    $prepare = $db->prepare("INSERT INTO comments (title, username, comment) VALUES (:title, :user, :comment)");
    $prepare->execute(['title'=>$_POST['title'], 'user'=>$_POST['username'], 'comment'=>$_POST['comment']]);
?>
