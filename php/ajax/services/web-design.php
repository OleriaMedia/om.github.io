<?php

    include_once "../../db.php";
    include_once "../../is-logged-in.php";

    function AddNewWebDesignOrder($websiteType, $budget, $description, $whatsAppNumber) {

        global $conn;

        date_default_timezone_set("Iran");

        $userID = $_SESSION["id"];
        $date = date("Y/m/d H:i:s");

        $query = "INSERT INTO 
        WebDesignProjects (USERID, WEBSITETYPE, BUDGET, DESCRIPTION, WHATSAPPNUMBER, SUBMITTIME)
        VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->execute([$userID, $websiteType, $budget, $description, $whatsAppNumber, $date]);

    }

    $data = [];

    $json = json_decode(file_get_contents("php://input"));
    
    if (!IsLoggedIn()) {

        $data["success"] = FALSE;

    } else {

        $data["success"] = TRUE;
        AddNewWebDesignOrder($json->websiteType, $json->budget, $json->description, $json->whatsAppNumber);

    }

    echo json_encode($data);

?>