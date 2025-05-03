<?php

include 'DBConnector.php';
// update submission
if (isset($_POST['EmpID'])) {
    $EmpID = $_POST['EmpID'];
    $name = $_POST['EmpName'];
    $age = $_POST['Age'];
    $salary = $_POST['Salary'];
    $hireDate = $_POST['HireDate'];

    $sql_update = "UPDATE employee SET EmpName = '$name', Age = '$age', Salary = '$salary', HireDate = '$hireDate' WHERE EmpID = '$EmpID'";
    
    if ($conn->query($sql_update) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating employee: " . $conn->error;
    }

// load employee attributes by id
} elseif (isset($_POST['EmpID'])) {
    $EmpID = $_POST["EmpID"];
    $sql_display = "SELECT * FROM employee WHERE EmpID = $EmpID";
    $result = $conn->query($sql_display);

    if ($result->num_rows > 0) {
        $emp_row = $result->fetch_assoc();

        echo "<form action='editEmployee.php' method='post'>".
            "<input type='hidden' name='EmpID' value='".$emp_row['EmpID']."'><br>".
            "Name: <input type='text' name='EmpName' value='".$emp_row['EmpName']."'><br>".
            "Age: <input type='number' name='Age' value='".$emp_row['Age']."'><br>".
            "Salary: <input type='number' name='Salary' value='".$emp_row['Salary']."'><br>".
            "Hire Date: <input type='date' name='HireDate' value='".$emp_row['HireDate']."'><br>".
            "<button type='submit'>Update Employee</button>".
        "</form>";
    } else {
        echo "Employee not found.";
    }
}
$conn->close();
?>
