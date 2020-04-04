<?php
require_once '../classes/CRUD.php';
try {
    $rawData = $_POST['data'];
    $json_Data = json_decode($rawData);


    //Parse first and last Name

    $name = $json_Data->name;
    $delimiter = ' ';
    $firstName = explode($delimiter, $name)[0];
    $lastName = explode($delimiter, $name)[1];


    //Add new name to DB
    addNames($firstName, $lastName);


    //pull  results from DB
    $names = readNames();


    //format results from DB


    $results = [masterstatus => 'ok', names => $names];
    echo json_encode($results);
} catch (Exception $e) {

    $results = [masterstatus => 'error', msg => $e->getMessage()];
    echo json_encode($results);
}
//write the code for adding and displaying the names here when the "Add Name" button is clicked
