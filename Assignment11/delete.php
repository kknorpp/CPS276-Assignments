<?php
//* Current Customer System
require_once('db.php');
if (empty($_REQUEST['deleteid'])) {
    header("Location: search.php");
}
$args = [];
$args[] = $_REQUEST['deleteid'];
$sql = "DELETE FROM a6_people WHERE personID = ?";
execute($sql,false,$args);
header("Location: search.php");

