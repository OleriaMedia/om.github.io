<?php

    include_once "../../db.php";

    session_start();

    $data = ["history" => GetHistory()];

    echo json_encode($data);


    function GetHistory() {

        global $conn;

        $userID = $_SESSION["id"];
        $tableNames = ["GraphicDesignProjects", "InstagramContentProjects", "LogoDesignProjects",
        "PhotographyProjects", "VideographyProjects", "WebDesignProjects"];

        foreach ($tableNames as $key => $tableName) {

            $query = "SELECT * FROM $tableName WHERE USERID = ?";
            $statement = $conn->prepare($query);
            $statement->execute($userID);
        }

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

?>