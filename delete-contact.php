<?php
require("includes/functions.inc.php");
if(isset($_GET['id'])){
    //Delete the contact with this id
    $id = $_GET['id'];
    $rows = db_select("SELECT * FROM contacts WHERE id = $id");
    if($row === false)
    {
        $error = db_error();
        dd($error);
    }
    //Found the user which has to be deleted!
    $image_name = $rows[0]['image_name'];
    unlink("images/users/$image_name");
    //Query To Delete the contact
    $sql = "DELETE FROM contacts WHERE id = $id";
    $result = db_query($sql);

    if($result)
    {
        header("Location: index.php?q=success&op=delete");
    }
    else
    {
        header("Location: index.php?q=error&op=delete");
    }
}
?>