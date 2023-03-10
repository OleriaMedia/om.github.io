<?php

require_once "../../../assets/php/db-details-class.php";
require_once "../../../assets/php/db-class.php";
require_once "../print-table.php";

if (empty($_GET["id"])) {
    
    echo "User ID Does Not Exist!";
    exit();
}

$id = $_GET["id"];

$db = new Database();

$table = $db->GetHistoryForUser($id);

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

    <?php

        PrintHistoryTables($table);

    ?>

</body>

</html>