<?php
//* mvc complete
require_once('model.php');
$name='';
$data = null;
if (!empty($_REQUEST['viewid'])) {
    $row = MyModel::getModel()->getDataForId($_REQUEST['viewid']);
    $personID = $row['personID'];
    $person_name = $row['person_name'];
    $provider_number = $row['provider_number'];
    $locationID = $row['locationID'];
    require_once('detailsView.php');
    exit(1);
}
if (!empty($_REQUEST['deleteid'])) {
    $personID = $_REQUEST['deleteid'];
    MyModel::getModel()->deletePerson($personID);
}
if (!empty($_REQUEST['save'])) {
    $personID = $_REQUEST['editid'];
    $person_name = $_REQUEST['person_name'];
    $provider_number = $_REQUEST['provider_number'];
    $locationID = $_REQUEST['locationID'];
    
    MyModel::getModel()->editPerson($personID, $person_name, $provider_number, $locationID);
    $row = MyModel::getModel()->getDataForId($personID);
    $person_name = $row['person_name'];
    $provider_number = $row['provider_number'];
    $locationID = $row['locationID'];
    require_once('detailsView.php');
    exit(1);
}

if (!empty($_REQUEST['editid'])) {
    $row = MyModel::getModel()->getDataForId($_REQUEST['editid']);
    $personID = $row['personID'];
    $person_name = $row['person_name'];
    $provider_number = $row['provider_number'];
    $locationID = $row['locationID'];
    require_once('editView.php');
    exit(1);
}



if (!empty($_REQUEST['name'])) {
    $name = $_REQUEST['name'];
    $data = MyModel::getModel()->getDataForName($name);
} else {
    $name = MyModel::getModel()->getNameFromSession();
    $data = MyModel::getModel()->getDataFromSession();
}


require_once('searchView.php');
