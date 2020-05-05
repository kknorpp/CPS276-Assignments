<html>
<div>
    <form action="index.php" enctype="multipart/form-data" method="post">
        <input type="submit" value="Upload File" name="upload" />&nbsp;
        <input accept=".csv,.txt" type="file" name="myfile" />
    </form>
</div>

</html>
<?php

function displayFileRecordTotalTableHeader()
{
    echo "<tr>";


    echo "<th>File Name</th>";

    echo "<th>Records</th>";

    echo "<th>Total</th>";

    echo "</tr>";
}
function calculateTotalAmount($data)
{
    $moneyPattern = '/\$\d{0,}\.\d{2}/';
    $total = 0;

    $rows = sizeof($data);
    for ($rowIndex = 0; $rowIndex < $rows; $rowIndex++) {
        $row = ($data[$rowIndex]);

        $matches = array();
        $numberOfMatches = preg_match($moneyPattern, $row, $matches);
        if ($numberOfMatches > 0) {
            $money = $matches[0];
            $moneyValue = floatval(preg_replace('/[^\d\.]/', '', $money));
            $total = $total + $moneyValue;
        }
    }

    return $total ;
}
function displayFileRecordTotalTable($fileName, $data)
{
    $recordCount = sizeof($data);
    $total = calculateTotalAmount($data);
    echo  "<table align='left' border='1'>";
    displayFileRecordTotalTableHeader();
    echo "<tr>";
    echo "<td>$fileName</td>";
    echo "<td>$recordCount</td>";
    echo "<td>$$total</td>";
    echo "</tr>";
    echo "</table>";
}


function displayDataTableHeader($data)
{


    echo "<tr>";


    echo "<th>Account</th>";

    echo "<th>Phone</th>";

    echo "<th>Amount</th>";

    echo "</tr>";
}


function displayDataTableRow($row)
{


    $matches = array();
    $accountMatch = '/[a-zA-Z]{2}((\d{8})|(\d{4}))/';
    $numberOfMatches = preg_match($accountMatch, $row, $matches);
    if ($numberOfMatches > 0) {
        $account = $matches[0];
    } else {
        $account = '';
    }



    $matches = array();
    $phonePattern = '/(\({0,1}\d{3}\){0,1}){0,1}[\s\-]{0,1}\d{3}[\s\-]\d{4}/';
    $numberOfMatches = preg_match($phonePattern, $row, $matches);
    if ($numberOfMatches > 0) {
        $phone = $matches[0];
    } else {
        $phone = '';
    }



    $matches = array();
    $moneyPattern = '/\$\d{0,}\.\d{2}/';
    $numberOfMatches = preg_match($moneyPattern, $row, $matches);
    if ($numberOfMatches > 0) {
        $money = $matches[0];
    } else {
        $money = '';
    }
    if (empty($account) && empty($phone) && empty($money)) {
    } else {
        echo "<tr>";
        echo "<td>$account</td>";
        echo "<td>$phone</td>";
        echo "<td>$money</td>";
        echo "</tr>";
    }
}






//* Uploading and reading a file
function displayDataTable($data)
{
    echo  "<table align='left' border='1'>";
    displayDataTableHeader($data);


    $columns = 3;
    $rows = sizeof($data);
    for ($rowIndex = 0; $rowIndex < $rows; $rowIndex++) {

        $row = ($data[$rowIndex]);

        displayDataTableRow($row);
    }
    echo "</table>";
}

$fileName = null;
$rawData = null;


if (isset($_REQUEST['upload']) && !empty($_FILES['myfile']['tmp_name'])) {
    $rawData = file($_FILES['myfile']['tmp_name'], FILE_SKIP_EMPTY_LINES);
    $fileName = $_FILES['myfile']['name'];

    displayFileRecordTotalTable($fileName, $rawData);


    echo "<br>";
    echo "<br>";
    echo "<br>";


    displayDataTable($rawData);
}
?>