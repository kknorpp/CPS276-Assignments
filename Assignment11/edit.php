<?php
//* Current Customer System
require_once('db.php');
if (!empty($_REQUEST['save']) || !empty($_REQUEST['back'])) {
    if (!empty($_REQUEST['save'])) {
        $sql = "UPDATE a6_people SET person_name = ?,provider_number = ?,locationID = ? WHERE personID = ?";
        $args = [];
        $args[] = $_REQUEST['person_name'];
        $args[] = $_REQUEST['provider_number'];
        $args[] = $_REQUEST['locationID'];
        $args[] = $_REQUEST['editid'];
        execute($sql,false,$args);
    }
    header("Location: search.php");
}
if (empty($_REQUEST['editid'])) {
    header("Location: search.php");
}
$args = [];
$args[] = $_REQUEST['editid'];
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
    <form action="controller.php" method="post">
        <input type="hidden" value="<?=$personID?>" name="editid">
        <input type="submit" value="Back" name="back">
        <input type="submit" value="Save" name="save">
        <br><br>
        <table border="1" cellspacing="0" cellpadding="2">
            <tr>
                <td><b>ID</b></td>
                <td><?=$personID?></td>
            </tr>
            <tr>
                <td><b>Person Name</b></td>
                <td><input name="person_name" type="text" value="<?=$person_name?>" size="35"></td>
            </tr>
            <tr>
                <td><b>Provider</b></td>
                <td><input name="provider_number" type="text" value="<?=$provider_number?>" size="35"></td>
            </tr>
            <tr>
                <td><b>Location</b></td>
                <td><input name="locationID" type="text" value="<?=$locationID?>" size="35"></td>
            </tr>
        </table>
    </form>
</html>


        
