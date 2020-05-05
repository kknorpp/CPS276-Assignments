<?php
//* Current Customer System
require_once('db.php');
if (empty($_REQUEST['viewid'])) {
    header("Location: search.php");
}
$args = [];
$args[] = $_REQUEST['viewid'];
$sql = "SELECT * FROM a6_people WHERE personID = ?";
$results = execute($sql,true,$args);
if (empty($results)) {
    header("Location: search.php");
}
$row = $results[0];
$personID = $row['personID'];
$person_name = $row['person_name'];
$provider_number = $row['provider_number'];
$locationID = $row['locationID'];
?>
<html>
    <a href="search.php">Go Back</a>
    <br><br>
    <table border="1" cellspacing="0" cellpadding="2">
        <tr>
            <td><b>ID</b></td>
            <td><?=$personID?></td>
        </tr>
        <tr>
            <td><b>Person Name</b></td>
            <td><?=$person_name?></td>
        </tr>
        <tr>
            <td><b>Provider</b></td>
            <td><?=$provider_number?></td>
        </tr>
        <tr>
            <td><b>Location</b></td>
            <td><?=$locationID?></td>
        </tr>
    </table>
</html>


        
