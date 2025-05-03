<?php
include 'DBConnector.php';

$emp_id = $_POST['EmpID'];
$sql_emp_data = "SELECT * FROM employee WHERE EmpID = $emp_id";
$result = $conn->query($sql_emp_data);

if ($result->num_rows == 1) {
    $emp_result = $result->fetch_assoc();

    if (isset($_POST['EmpName'], $_POST['Age'], $_POST['Salary'], $_POST['HireDate'])) {
        $emp_name = $_POST['EmpName'];
        $age = $_POST['Age'];
        $salary = $_POST['Salary'];
        $hire_date = $_POST['HireDate'];

        $sql_edit_emp = "UPDATE employee SET EmpName = '$emp_name', Age = '$age', Salary = '$salary', HireDate = '$hire_date' WHERE EmpID = '$emp_id'";
        
        if ($conn->query($sql_edit_emp)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error editing employee: " . $conn->error;
        }
    }

    echo "<form action='editEmployee.php' method='post'>".
            "<input type='hidden' name='EmpID' value='".$emp_result['EmpID']."'><br>".
            "Name: <input type='text' name='EmpName' value='".$emp_result['EmpName']."'><br>".
            "Age: <input type='number' name='Age' value='".$emp_result['Age']."'><br>".
            "Salary: <input type='number' step='.01' name='Salary' value='".$emp_result['Salary']."'><br>".
            "Hire Date: <input type='date' name='HireDate' value='".$emp_result['HireDate']."'><br>".
            "<button type='submit'>Update Employee</button>".
        "</form>";
} else {
    echo "Employee not found.";
}

$conn->close();
?>