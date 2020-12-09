<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_base = "student";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_base);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleTwo.css">
    <link rel="stylesheet" href="styleThree.css">
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
            <div class="search">
                <div class="title">
                    <h1>Search</h1>
                </div>
                <table>
                    <form action="" method="post">
                        <tr>
                            <td><label for="class" class="lablename">Class</label></td>
                            <td><input type="text" name="class" id="class" class="textbox" required></td>
                        </tr>
                        <tr>
                            <td><label for="semester" class="lablename">Semester</label></td>
                            <td><input type="text" name="semester" id="semester" class="textbox" required></td>
                        </tr>
                        <tr>
                            <td><label for="subject" class="lablename">Subject</label></td>
                            <td><input type="text" name="subject" id="subject" class="textbox" required></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Search" class=submit name="submit"></td>
                            <td style="text-align: left;"><input type="submit" value="Clear" class=clear></td>
                        </tr>
                    </form>
                </table>
            </div>
            <?php
            if (isset($_POST['submit'])) {
                $sqlThree = `SELECT * FROM subject WHERE class={$_REQUEST['class']} AND semester={$_REQUEST['semester']} AND subject={$_REQUEST['subject']} ORDER BY year DESC;`;

                $result = mysqli_real_query($conn, $sqlThree);
                $number = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="details">
                        <div>
                            <h3>' . $number . '</h3>
                        </div>
                        <div>
                            <h3>' . $row['subject'] . '</h3>
                        </div>
                        <div>
                            <h3>' . $row['semester'] . '</h3>
                        </div>
                        <div>
                            <h3>' . $row['year'] . '</h3>
                        </div>
                        <div>
                            <form action="" method="post" style="display: inline;">
                                <button name="edit" type="submit" class="submit" value="' . $row['id'] . '" style="background-color: green;">Download</button>
                            </form>
                        </div>
                    </div>';
                    $number++;
                }
            }
            ?>
        </div>
    </main>
</body>

</html>