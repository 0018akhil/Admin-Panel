<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_base = "student";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_base);

if (isset($_POST['submit'])) {
    $class = $_REQUEST['class'];
    $semester = $_REQUEST['semester'];
    $subject = $_REQUEST['subject'];
    $medium = $_REQUEST['medium'];
    $year = $_REQUEST['year'];

    $sql = "INSERT INTO subject (class, semester, subject, medium, year) VALUES (?, ?, ?, ?, ?);";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sssss", $class, $semester, $subject, $medium, $year);

    mysqli_stmt_execute($stmt);
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
    </main>
</body>

</html>