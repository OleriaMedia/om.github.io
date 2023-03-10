<?php

    include_once "../../db.php";
    include_once "../../is-logged-in.php";

    function AddNewLogoDesignOrder($logoType, $deliveryTime, $description, $whatsAppNumber) {

        global $conn;

        date_default_timezone_set("Iran");
        
        $date = date("Y/m/d H:i:s");
        $userID = $_SESSION["id"];

        $query = "INSERT INTO 
        LogoDesignProjects (USERID, LOGOTYPE, DELIVERYTIME, DESCRIPTION, WHATSAPPNUMBER, SUBMITTIME)
        VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->execute([$userID, $logoType, $deliveryTime, $description, $whatsAppNumber, $date]);

    }

    $data = [];

    $json = json_decode(file_get_contents("php://input"));
    
    if (!IsLoggedIn()) {

        $data["success"] = FALSE;

    } else {

        $data["success"] = TRUE;
        AddNewLogoDesignOrder($json->logoType, $json->deliveryTime, $json->description, $json->whatsAppNumber);

    }

    echo json_encode($data);

?>