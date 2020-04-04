<?php
require_once 'Pdo_methods.php';

//add names function
function addNames($firstName, $lastName)
{

    $pdo = new PdoMethods();

    /* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
    $sql = "insert into ajaxNames (firstName, lastName) values (:firstName,:lastName)";

    /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
    $bindings = [
        [':firstName', $firstName, 'str'],
        [':lastName', $lastName, 'str'],

    ];

    /* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
    $result = $pdo->otherBinded($sql, $bindings);

    /* HERE I AM USING AN OBJECT TO RETURN WHETHER SUCCESSFUL FOR ERROR */
    if ($result === 'error') {
        return 'There was an error adding the name';
    } else {
        return 'name has been added';
    }
}

//reads names out of DB

function readNames()
{


    /* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
    $pdo = new PdoMethods();

    /* CREATE THE SQL */
    $sql = "SELECT * FROM ajaxNames 
        Order By lastName";
    $records = $pdo->selectNotBinded($sql);
    /* IF THERE WAS AN ERROR DISPLAY MESSAGE */
    if ($records == 'error') {
        return '';
    } else {

        $list = '';
        foreach ($records as $row) {
            $list .= "{$row['lastName']}, {$row['firstName']}\n";
        }

        return $list;
    }
}
