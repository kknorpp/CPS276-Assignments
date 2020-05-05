<?php
//* Current Customer System
require_once('db.php');
$name = '';
$data = null;
if (!empty($_REQUEST['name'])) {
    $name = $_REQUEST['name'];
    $args = [];
    $args[] = $name . '%';
    $sql = "SELECT person_name,provider_number,personID FROM a6_people WHERE person_name LIKE ?";
    $data = execute($sql, true, $args);
 }
?>
<html>
<form action="search.php" method="post">
    <input type="submit" value="Search">
    <input size=40 type="text" name="name" value="<?= $name ?>" placeholder="Name Starts With">
</form>
<? if (!empty($data)) { ?>
    <table border="1" cellspacing="0" cellpadding="2">
        <tr>
            <th>Name</th>
            <th>Provider</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php
        foreach ($data as $row) {
            $person_name = $row['person_name'];
            $provider_number = $row['provider_number'];
            $personID = $row['personID'];
            echo "<tr>
            <td>$person_name</td>
            <td>$provider_number</td>
            <td><a href=\"details.php?viewid=$personID\">Details</a></td>
            <td><a href=\"edit.php?editid=$personID\">Edit</a></td>
            <td><a onclick=\"return confirm('Delete?');\" href=\"delete.php?deleteid=$personID\">Delete</a></td>
        </tr>";
        }
        ?>
    </table>
<? } ?>

</html>