<?php
include 'DBConnector.php';

$sql = "SELECT * FROM employee INNER JOIN work ON employee.EmpID = work.EmpID WHERE DeptID = 3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>".
            "<td align='center'>".$row["EmpID"]."</td>".
            "<td align='center'>".$row["EmpName"]."</td>".
            "<td align='center'>".$row["Age"]."</td>".
            "<td align='center'>".$row["Salary"]."</td>".
            "<td align='center'>".$row["HireDate"]."</td>".
            "</tr>";
    }
}
else {
    echo "0 results";
}

$conn->close();
?>