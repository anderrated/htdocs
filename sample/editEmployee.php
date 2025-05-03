<?php
include 'DBConnector.php';

if (isset($_POST['EmpID'])) {
    $EmpID = $_POST["EmpID"];
    // display employee details
    $sql_display = "SELECT * FROM employee WHERE EmpID = $EmpID";
    $result = $conn->query($sql_display);

    if ($result->num_rows > 0) {
        $emp_row = $result->fetch_assoc();

        $name = $_POST["name"];
        $age = $_POST["age"];
        $salary = $_POST["salary"];
        $HireDate = $_POST["date_hired"];

        echo form
    } else {
        echo "Employee not found."
    }
}
