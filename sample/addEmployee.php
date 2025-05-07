<?php
include 'DBConnector.php';

$name = $_GET["name"];
$age = $_GET["age"];
$salary = $_GET["salary"];
$HireDate = $_GET["date-hired"];
$DeptID = $_GET["department"];
$Percent_Time = $_GET["percent_time"];

$sql = "INSERT INTO `employee` (`EmpID`, `EmpName`, `Age`, `Salary`, `HireDate`)
        VALUES (NULL, '$name', '$age', '$salary', '$HireDate');";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    $query = "INSERT INTO `work` (`EmpID`, `DeptID`, `Percent_Time`)
              VALUES ('$last_id', '$DeptID', '$Percent_Time');";
    $result = $conn->query($query);
    header("Location: employees.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
