<?php
include 'DBConnector.php';

$name = $_POST["name"];
$age = $_POST["age"];
$salary = $_POST["salary"];
$HireDate = $_POST["date-hired"];
$DeptID = $_POST["department"];
$Percent_Time = $_POST["percent_time"];
$designation = $_POST["designation"];

$sql = "INSERT INTO `employee` (`EmpID`, `EmpName`, `Age`, `Salary`, `HireDate`)
        VALUES (NULL, '$name', '$age', '$salary', '$HireDate');";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    $query = "INSERT INTO `work` (`EmpID`, `DeptID`, `Percent_Time`)
              VALUES ('$last_id', '$DeptID', '$Percent_Time');";
    $conn->query($query);
    // if statement check if designation == 2, if yes then replace mngrEmpID of departments to this emp's ID
    if ($designation == "2") {
        // update department manager to new employee
        $mgr_query = "UPDATE department SET MgrEmpID = '$last_id' WHERE DeptID = '$DeptID'";
        $conn->query($mgr_query);
    }
    // redirect after successful addition
    header("Location: employees.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
