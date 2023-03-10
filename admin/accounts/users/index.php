<?php

require_once "../../../assets/php/db-details-class.php";
require_once "../../../assets/php/db-class.php";
require_once "../print-table.php";

$db = new Database();

$query = "SELECT * FROM Users ORDER BY ID DESC";
$table = $db->Query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Users</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../tableStyle.css">
</head>

<body>

    <table>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PASSWORD</th>
            <th>PHONENUMBER</th>
        </tr>

        <?php

            PrintUserTable($table);

        ?>
        
    </table>

</body>

</html>