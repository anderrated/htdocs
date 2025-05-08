<?php
include 'DBConnector.php';

if (isset($_POST['EmpID'])) {
    $emp_id = $_POST['EmpID'];

    // Get employee's current record
    $result = $conn->query("SELECT * FROM employee 
        JOIN work ON employee.EmpID = work.EmpID 
        JOIN department ON work.DeptID = department.DeptID 
        WHERE employee.EmpID = '$emp_id'");

    if ($result->num_rows == 1) {
        $emp_result = $result->fetch_assoc();

        include 'employees.php';

        // check if form was submitted with all needed fields
        if (isset($_POST['name'], $_POST['age'], $_POST['salary'], $_POST['date-hired'], $_POST['designation'], $_POST['department'])) {
            $emp_name = $_POST['name'];
            $age = $_POST['age'];
            $salary = $_POST['salary'];
            $hire_date = $_POST['date-hired'];
            $designation = $_POST['designation'];
            $dept_id = $_POST['department'];

            // update employee info
            $update_emp_sql = "UPDATE employee SET EmpName = '$emp_name', Age = '$age', Salary = '$salary', HireDate = '$hire_date' WHERE EmpID = '$emp_id'";

            if ($conn->query($update_emp_sql) === TRUE) {
                // update work table to reflect department
                $update_work_sql = "UPDATE work SET DeptID = '$dept_id' WHERE EmpID = '$emp_id'";
                $conn->query($update_work_sql);

                // manager logic
                if ($designation == "2") {
                    $conn->query("UPDATE department SET MgrEmpID = '$emp_id' WHERE DeptID = '$dept_id'");
                } else {
                    $conn->query("UPDATE department SET MgrEmpID = NULL WHERE MgrEmpID = '$emp_id' AND DeptID = '$dept_id'");
                }

                // Redirect to employees list or confirmation
                header("Location: employees.php");
                exit();
            } else {
                echo "Error updating Employee: " . $conn->error;
            }
        } else {
            echo "Missing fields in form submission.";
        }
    } else {
        echo "Employee not found.";
    }
} else {
    echo "EmpID not set.";
}

$conn->close();
?>
