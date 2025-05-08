<?php
include 'DBConnector.php';

$sql_get_departments = "SELECT * FROM department";
$dept_result = $conn->query($sql_get_departments);

if ($dept_result->num_rows > 0) {
    while ($dept = $dept_result->fetch_assoc()) {
        $deptID = $dept['DeptID'];
        $deptName = $dept['DeptName'];
        $mgrEmpID = $dept['MgrEmpID'];

        echo "<h2 style='color: white;'>$deptName</h2>";
        echo "<table border='1' style='width: 100%; color: white;'>";
        echo "<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Salary</th>
                <th>Hire Date</th>
                <th>Designation</th>
                <th>Action</th>
              </tr>";

        $sql_get_employees = "SELECT * FROM employee JOIN work ON employee.EmpID = work.EmpID WHERE DeptID = '$deptID'";
        $emp_result = $conn->query($sql_get_employees);

        if ($emp_result->num_rows > 0) {
            while($emp_row = $emp_result->fetch_assoc()) {
                $empID = $emp_row['EmpID'];
                $name = htmlspecialchars($emp_row['EmpName']); 

                echo "<tr>"
                        ."<td align='center'>".$emp_row['EmpID']."</td>"
                        ."<td align='center'>".$emp_row['EmpName']."</td>"
                        ."<td align='center'>".$emp_row['Age']."</td>"
                        ."<td align='center'>".$emp_row['Salary']."</td>"
                        ."<td align='center'>".$emp_row['HireDate']."</td>";
                if ($mgrEmpID == $empID) {
                    echo "<td align='center'>Manager</td>";
                }
                else {
                    echo "<td align='center'>Employee</td>";
                }
                echo "<td align='center'>
                        <form action='deleteEmployee.php' method='post' onsubmit=\"return confirm('Are you sure you want to delete this employee?');\">
                            <input type='hidden' name='EmpID' value='".$emp_row["EmpID"]."'>
                            <button type='submit'>Delete</button>
                        </form>

                        <form action='editEmployee.php' method='post'>
                            <input type='hidden' name='EmpID' value='".$emp_row["EmpID"]."'>
                            <button type='submit' name='edit'>Edit</button>
                        </form>
                    </td>";

                echo "</tr>";
            }
        } else {
            echo "0 results";
        }

        echo "</table><br><br>";
    }
} else {
    echo "No departments found.";
}

// $conn->close();
?>
