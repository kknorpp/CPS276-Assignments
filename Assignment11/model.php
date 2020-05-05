<?php
//* mvc complete
require_once('db.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class MyModel
{
    private static $modelInstance = null;

    public static function getModel()
    {
        if (self::$modelInstance == null) {
            self::$modelInstance = new MyModel();
        }
        return self::$modelInstance;
    }

    public function getNameFromSession()
    {
        if (empty($_SESSION['name'])) {
            return '';
        }
        return $_SESSION['name'];
    }

    public function getDataFromSession()
    {
        if (empty($_SESSION['data'])) {
            return [];
        }
        return $_SESSION['data'];
    }

    public function getDataForId($id)
    {
        if (empty($id)) {
            return [];
        }
        $args = [];
        $args[] = $id;
        $sql = "SELECT * FROM a6_people WHERE personID = ?";
        $results = execute($sql, true, $args);
        if (empty($results)) {
            return [];
        }
        return $results[0];
    }

    public function getDataForName($name)
    {
        if (empty($name)) {
            return [];
        }
        $args = [];
        $args[] = $name . '%';
        $sql = "SELECT person_name,provider_number,personID FROM a6_people WHERE person_name LIKE ?";
        $results = execute($sql, true, $args);
        $_SESSION['data'] = $results;
        $_SESSION['name'] = $name;
        return $results;
    }

    public function editPerson($personID, $person_name, $provider_number, $locationID)
    {
        $sql = "UPDATE a6_people SET person_name = ?,provider_number = ?,locationID = ? WHERE personID = ?";
        $args = [];
        $args[] = $person_name;
        $args[] = $provider_number;
        $args[] = $locationID;
        $args[] = $personID;
        execute($sql, false, $args);
    }

    public function deletePerson()
    {
        $args = [];
        $args[] = $_REQUEST['deleteid'];
        $sql = "DELETE FROM a6_people WHERE personID = ?";
        execute($sql, false, $args);
    }
}
