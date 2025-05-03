<?php
include 'DBConnector.php';

// load employee attributes by id
if (isset($_POST['EmpID'])) {
    $empID = $_POST["EmpID"];
    $sql_display = "SELECT * FROM employee WHERE EmpID = $empID";
    $result = $conn->query($sql_display);

    if ($result->num_rows > 0) {
        $emp_row = $result->fetch_assoc();

        if (isset($_POST['EmpName'], $_POST['Age'], $_POST['Salary'], $_POST['HireDate'])) {
            $empName = $_POST['EmpName'];
            $age = $_POST['Age'];
            $salary = $_POST['Salary'];
            $hireDate = $_POST['HireDate'];

            $sql_update = "UPDATE employee SET EmpName = '$empName', Age = '$age', Salary = '$salary', HireDate = '$hireDate' WHERE EmpID = '$empID'";
            
            if ($conn->query($sql_update) === TRUE) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error updating employee: " . $conn->error;
            }
        }
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
