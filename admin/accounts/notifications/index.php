<?php

require_once "../../../assets/php/db-details-class.php";
require_once "../../../assets/php/db-class.php";
require_once "../print-table.php";

function AddNewNotification($userID, $title, $message) {

    $query = "INSERT INTO Notifications (USERID, TITLE, MESSAGE, COLOR) 
    VALUES (?, ?, ?, ?)";
    $db = new Database();
    $color = "red";
    $db->PreparedStatement($query, [$userID, $title, $message, $color]);

}

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {

    if (empty($_POST["ID"]) or empty($_POST["TITLE"]) or empty($_POST["MESSAGE"])) {

        $error = "پیام یا آی دی خالی است";
    } else {

        $userID = $_POST["ID"];
        $title = $_POST["TITLE"];
        $message = $_POST["MESSAGE"];

        AddNewNotification($userID, $title, $message);
    }
}

$db = new Database();
$table = $db->GetAllNotifications();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../tableStyle.css">
</head>

<body>

    <form action="" method="post">

        <h1>Send A Notification</h1>
        For User With ID: <input type="number" name="ID">
        Notification Title: <input type="text" name="TITLE">
        Notification Message: <input type="text" name="MESSAGE">
        <button type="submit">Send</button>

    </form>

    <?php

    PrintNotificationTables($table);

    ?>

</body>

</html>