<?php

    include_once "../../db.php";

    session_start();

    $data = ["notifs" => GetNotifications()];

    echo json_encode($data);


    function GetNotifications() {

        global $conn;

        $query = "SELECT * FROM Notifications WHERE USERID = ?";
        $statement = $conn->prepare($query);
        $statement->execute($_SESSION["id"]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

?>