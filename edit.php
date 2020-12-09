<?php
session_start();
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_base = "student";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_base);
$id =  $_SESSION['identity'];
$sql = "SELECT * FROM subject WHERE id=" . $id . ";";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $class = $row['class'];
    $semester = $row['semester'];
    $subject = $row['subject'];
    $medium = $row['medium'];
    $year = $row['year'];
}

if (isset($_REQUEST['edit'])) {
    $sqlTwo = "UPDATE subject SET class=(?), semester=(?), subject=(?), medium=(?), year=(?) WHERE id=(?);";

    $stmtTwo = mysqli_prepare($conn, $sqlTwo);

    mysqli_stmt_bind_param($stmtTwo, "sssssi", $_REQUEST['class'], $_REQUEST['semester'], $_REQUEST['subject'], $_REQUEST['medium'], $_REQUEST['year'], $id);

    mysqli_stmt_execute($stmtTwo);

    session_unset();
    session_destroy();
    header("Location: ./index.php", true);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleTwo.css">
</head>

<body>
    <header>
        <h3>User Panel</h3>
    </header>
    <main>
        <div class="sidebar">
            <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class="options">
                <option value="">Records</option>
                <option value="index.php">New Record</option>
                <option value="show.php">Old Record</option>
            </select>
        </div>
        <div calss="mainshow">
            <table>
                <form action="" method="post">
                    <tr>
                        <td><label for="class" class="lablename">Class</label></td>
                        <td><input value="<?php echo $class ?>" type="text" name="class" id="class" class="textbox" required></td>
                    </tr>
                    <tr>
                        <td><label for="semester" class="lablename">Semester</label></td>
                        <td><input value="<?php echo $semester ?>" type="text" name="semester" id="semester" class="textbox" required></td>
                    </tr>
                    <tr>
                        <td><label for="subject" class="lablename">Subject</label></td>
                        <td><input value="<?php echo $subject ?>" type="text" name="subject" id="subject" class="textbox" required></td>
                    </tr>
                    <tr>
                        <td><label for="medium" class="lablename">Medium</label></td>
                        <td><select value="<?php echo $medium ?>" name="medium" id="medium" class="textbox">
                                <option value="english">English</option>
                                <option value="hindi">Hindi</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td><label for="year" class="lablename">Paper Year</label></td>
                        <td><input value="<?php echo $year ?>" type="date" name="year" id="year" class="textbox" required></td>
                    </tr>
                    <tr>
                        <td><label for="File" class="lablename">Upload file</label></td>
                        <td style="text-align: left;"><input type="file" name="File" id="File"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Edit" class=submit name="edit"></td>
                        <td style="text-align: left;"><input type="submit" value="Clear" class=clear></td>
                    </tr>
                </form>
            </table>

        </div>
    </main>
</body>

</html>