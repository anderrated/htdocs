
<!DOCTYPE html>
<style>
    body {
        font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
        background-image: url('b2.png');
        background-repeat: no-repeat;
        background-size: cover;
        color: white;
    }
    td.tlabel {
        width: 90px;
        text-align: right;
        padding-right: 10px;
    }
    .expand {
        width: 170px;
    }
</style>
<body>
    <?php
        $update = isset($_POST['edit']);
    ?>
    <h1>Employee Management</h1>
    <br>
    <h3>New Employee:</h3>
    <form action="<?= isset($emp_result) ? 'editEmployee.php' : 'addEmployee.php'; ?>" method="post">
        <!-- EmpID hidden during edit mode -->
         <?php if (isset($emp_result)) { ?>
            <input type="hidden" name="EmpID" value="<?= $emp_result['EmpID']; ?>">
         <?php } ?>
        <table style="width:100%">
            <tr>
                <td class="tlabel">Name</td>
                <td><input type="text" name="name" value="<?= isset($emp_result['EmpName']) ? $emp_result['EmpName'] : '' ?>"></td>
            </tr>
            <tr>
                <td class="tlabel">Age</td>
                <td><input type="number" name="age" value="<?= isset($emp_result['Age']) ? $emp_result['Age'] : '' ?>"></td>
            </tr>
            <tr>
                <td class="tlabel">Salary</td>
                <td><input type="number" step=".01" name="salary" value="<?= isset($emp_result['Salary']) ? $emp_result['Salary'] : '' ?>"></td>
            </tr>
            <tr>
                <td class="tlabel">Percent Time</td>
                <td><input type="text" name="percent_time" value="<?= isset($emp_result['Percent_Time']) ? $emp_result['Percent_Time'] : '' ?>"></td>
            </tr>
            <tr>
                <td class="tlabel">Date Hired</td>
                <td><input class=expand type="date" name="date-hired" value="<?= isset($emp_result['HireDate']) ? $emp_result['HireDate'] : '' ?>"></td>
            </tr>
            <tr>
                <td class="tlabel">Department</td>
                <td>
                    <select class="expand" name="department">
                        <option value="" disabled="">--Select Department--</option>
                        <?php
                            include 'allDepartment.php';
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="tlabel">Designation</td>
                <td>
                    <input type="radio" name="designation" value="1" <?= isset($emp_result['MgrEmpID']) && $emp_result['MgrEmpID'] == NULL ? 'checked' : '' ?>> Employee<br>
                    <input type="radio" name="designation" value="2" <?= isset($emp_result['MgrEmpID']) && $emp_result['MgrEmpID'] != NULL ? 'checked' : '' ?>> Manager<br>
                </td>
            </tr>
            <tr>
                <td class="tlable">Actions</td>
            </tr>
            <tr>
                <td class="tlabel"></td>
                <td><button type="submit"><?= $update ? 'Update' : 'Add'; ?> Employee</button></td>
            </tr>
        </table>
    </form>

    <h2>All Employees</h2>
    <br>
    <?php
        include 'employees_per_dept.php';
    ?>

</body>
</html>

