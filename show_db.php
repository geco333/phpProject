<?php        
    require_once('ConnectToDatabase.php');

    $filter = "WHERE maintable." . $_POST['search_key'] . " LIKE '" . $_POST['search'] . "%'";

    if($_POST['filter_group'] == 'by_rated')
        $filter = $filter . " AND maintable.rated='" . $_POST['filter'] . "'";
    elseif($_POST['filter_group'] == 'by_score')
        $filter = $filter . " AND ratings." . $_POST['filter'] . $_POST['filter_cond'] . "'" . $_POST['filter_text'] . "'";
        
    $order = "maintable." . $_POST['sort'];

    if($_POST['sort_group'] == 'by_score')
        $order = "ratings." . $_POST['sort'];
        
    // Check if title exists in database.
    $query = $db->query("SELECT * FROM maintable JOIN ratings ON maintable.title=ratings.title " . $filter . " ORDER BY " . $order . " DESC"); 

    echo json_encode($query->fetchAll());
?>
