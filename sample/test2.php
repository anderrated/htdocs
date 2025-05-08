<?php
include 'DBConnector.php';

if (isset($_POST['EmpID'])) {
    $emp_id = $_POST['EmpID'];

    // Get the current employee data
    $result = $conn->query("SELECT * FROM employee JOIN work ON employee.EmpID = work.EmpID JOIN department ON work.DeptID = department.DeptID WHERE employee.EmpID = '$emp_id'");

    if ($result->num_rows == 1) {
        $emp_result = $result->fetch_assoc();

        // Check if the form fields are set for updating
        if (isset($_POST['EmpName'], $_POST['Age'], $_POST['Salary'], $_POST['HireDate'], $_POST['designation'], $_POST['department'])) {
            // Retrieve data from the form submission
            $emp_name = $_POST['EmpName'];
            $age = $_POST['Age'];
            $salary = $_POST['Salary'];
            $hire_date = $_POST['HireDate'];
            $designation = $_POST['designation'];
            $dept_id = $_POST['department']; // Department selected

            // Update employee data
            $update_emp_sql = "UPDATE employee SET EmpName = '$emp_name', Age = '$age', Salary = '$salary', HireDate = '$hire_date' WHERE EmpID = '$emp_id'";
            if ($conn->query($update_emp_sql) === TRUE) {
                
                // Update department information for the employee
                $update_work_sql = "UPDATE work SET DeptID = '$dept_id' WHERE EmpID = '$emp_id'";
                if ($conn->query($update_work_sql) === TRUE) {

                    // Handle manager designation if the employee is assigned as manager
                    if ($designation == "2") {
                        // If the employee is a manager, update the department manager to this employee's ID
                        $update_mgr_sql = "UPDATE department SET MgrEmpID = '$emp_id' WHERE DeptID = '$dept_id'";
                        if ($conn->query($update_mgr_sql) === TRUE) {
                            // Redirect after successful update
                            header("Location: index.php");
                            exit();
                        } else {
                            echo "Error updating manager: " . $conn->error;
                        }
                    }
                    // If the employee is being demoted from manager to regular employee
                    elseif ($designation == "1") {
                        // Set the department manager to NULL if the employee is no longer a manager
                        $remove_mgr_sql = "UPDATE department SET MgrEmpID = NULL WHERE MgrEmpID = '$emp_id' AND DeptID = '$dept_id'";
                        if ($conn->query($remove_mgr_sql) === TRUE) {
                            // Redirect after successful demotion
                            header("Location: index.php");
                            exit();
                        } else {
                            echo "Error removing manager: " . $conn->error;
                        }
                    } else {
                        echo "Invalid designation.";
                    }
                } else {
                    echo "Error updating work information: " . $conn->error;
                }
            } else {
                echo "Error updating employee: " . $conn->error;
            }
        }
    } else {
        echo "Employee not found.";
    }
} else {
    echo "Employee ID not set.";
}

$conn->close();
?>
