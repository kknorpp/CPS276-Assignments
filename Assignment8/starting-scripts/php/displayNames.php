<?php
require_once '../classes/CRUD.php';

try {
    //write the code for displaying the names when the "Display Names" button is clicked here.

    $names = readNames();

    $results = [masterstatus => 'ok', names => $names];
    // print_r(json_decode($_POST['data']));
    echo json_encode($results);
} catch (Exception $e) {

    $results = [masterstatus => 'error', msg => $e->getMessage()];
    echo json_encode($results);
}
?>