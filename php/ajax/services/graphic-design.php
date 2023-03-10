<?php

    include_once "../../db.php";
    include_once "../../is-logged-in.php";

    function AddNewGraphicDesignOrder($designType, $deliveryTime, $description, $whatsAppNumber) {

        global $conn;

        date_default_timezone_set("Iran");

        $date = date("Y/m/d H:i:s");
        $userID = $_SESSION["id"];

        $query = "INSERT INTO 
        GraphicDesignProjects (USERID, DESIGNTYPE, DELIVERYTIME, DESCRIPTION, WHATSAPPNUMBER, SUBMITTIME)
        VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->execute([$userID, $designType, $deliveryTime, $description, $whatsAppNumber, $date]);

    }

    $data = [];

    $json = json_decode(file_get_contents("php://input"));
    
    if (!IsLoggedIn()) {

        $data["success"] = FALSE;

    } else {

        $data["success"] = TRUE;
        AddNewGraphicDesignOrder($json->designType, $json->suggestedTime, $json->description, $json->whatsAppNumber);

    }

    echo json_encode($data);

?>