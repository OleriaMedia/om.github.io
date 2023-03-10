<?php

    include_once "../../db.php";
    include_once "../../is-logged-in.php";

    function AddNewInstagramContentOrder($pageType, $serviceType, $description, $pageID, $whatsAppNumber) {

        global $conn;

        date_default_timezone_set("Iran");
    
        $date = date("Y/m/d H:i:s");
        $userID = $_SESSION["id"];

        $query = "INSERT INTO 
        InstagramContentProjects (USERID, PAGETYPE, SERVICETYPE, DESCRIPTION, PAGEID, WHATSAPPNUMBER, SUBMITTIME)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->execute([$userID, $pageType, $serviceType, $description, $pageID, $whatsAppNumber, $date]);

    }

    $data = [];

    $json = json_decode(file_get_contents("php://input"));
    
    if (!IsLoggedIn()) {

        $data["success"] = FALSE;

    } else {

        $data["success"] = TRUE;
        AddNewInstagramContentOrder($json->pageType, $json->serviceType, $json->description, $json->pageID, $json->whatsAppNumber);

    }

    echo json_encode($data);

?>