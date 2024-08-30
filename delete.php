<?php

if(isset ($_GET["id"])){
    $id= $_GET["id"];

    $connection = new mysqli('localhost', 'root', '', 'crudoperations');

    $sql = "DELETE FROM clients WHERE id=$id";
    $connection->query($sql);
}

header("location:showdata.php");
exit;

?>