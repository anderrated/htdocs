<?php
include 'DBConnector.php';

$emp_id = $_POST['EmpID'];

$result = $conn->query("SELECT * FROM employee JOIN work ON employee.EmpID = work.EmpID JOIN department ON work.DeptID = department.DeptID WHERE employee.EmpID = '$emp_id'");

if ($result->num_rows == 1) {
    $emp_result = $result->fetch_assoc();

    if (isset($_POST['EmpName'], $_POST['Age'], $_POST['Salary'], $_POST['HireDate'])) {
        $emp_name = $_POST['EmpName'];
        $age = $_POST['Age'];
        $salary = $_POST['Salary'];
        $hire_date = $_POST['HireDate'];
        // $dept_id = $_POST['DeptID'];
        $designation = $_POST['designation'];
        // $mgr_emp_id = $_POST['MgrEmpID'];

        $my_sql = $conn->query("UPDATE employee SET EmpName = '$emp_name', Age = '$age', Salary = '$salary', HireDate = '$hire_date' WHERE EmpID = '$emp_id'");
        $dept_query = "SELECT DeptID FROM work WHERE EmpID = '$emp_id'";
        $dept_result = $conn->query($dept_query);

        if ($dept_result->num_rows > 0) {
            $dept_row = $dept_result->fetch_assoc();
            $dept_id = $dept_row['DeptID'];
            $mgr_result = $conn->query("SELECT MgrEmpID FROM department WHERE DeptID = '$dept_id'");
            $current_manager = ($mgr_result->num_rows > 0) ? $mgr_result->fetch_assoc()['MgrEmpID'] : NULL;
        
            // check employee
            if ($designation == "1") {
                $conn->query("UPDATE department SET MgrEmpID = NULL WHERE MgrEmpID = '$emp_id';");
                header("Location: index.php");
                exit();
            }
            // check manager
            elseif ($designation == "2") {
                $conn->query("UPDATE department SET MgrEmpID = '$emp_id' WHERE DeptID = '$dept_id';");
                header("Location: index.php");
                exit();
            }
            else {
                echo "Error editing employee: " . $conn->error;
            }
        }
    }

    include 'employees.php';

} else {
    echo "Employee not found.";
}

?>