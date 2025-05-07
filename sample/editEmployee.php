<?php
include 'DBConnector.php';

$emp_id = $_POST['EmpID'];
$sql_emp_data = "SELECT * FROM employee JOIN work ON employee.EmpID = work.EmpID JOIN department ON work.DeptID = department.DeptID WHERE employee.EmpID = $emp_id";
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

    include 'employees.php';

} else {
    echo "Employee not found.";
}

?>