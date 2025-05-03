<?php
include 'DBConnector.php';

if (isset($_POST['EmpID'])) {
    $EmpID = $_POST["EmpID"];
    $sql_works = "DELETE FROM work WHERE EmpID = $EmpID";
    $sql_employee = "DELETE FROM employee WHERE EmpID = $EmpID";

    $conn->query($sql_works);
    $conn->query($sql_employee);
    
    header("Location: index.php");
    exit();
} else {
    echo "Error deleting employee: " . $conn->error;
}

$conn->close();
?>