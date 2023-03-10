<?php

    include_once "../../db.php";
    include_once "../../is-logged-in.php";

    function AddNewVideographyOrder($videoType, $city, $whatsAppNumber, $shootingDate, $deliveryDate) {

        global $conn;

        date_default_timezone_set("Iran");
        
        $userID = $_SESSION["id"];
        $date = date("Y/m/d H:i:s");

        $query = "INSERT INTO 
        VideographyProjects (USERID, VIDEOTYPE, CITY, WHATSAPPNUMBER, SHOOTINGDATE, DELIVERYDATE, SUBMITTIME)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->execute([$userID, $videoType, $city, $whatsAppNumber, $shootingDate, $deliveryDate, $date]);

    }

    $data = [];

    $json = json_decode(file_get_contents("php://input"));
    
    if (!IsLoggedIn()) {

        $data["success"] = FALSE;

    } else {

        $data["success"] = TRUE;
        AddNewVideographyOrder($json->videoType, $json->city, $json->whatsAppNumber, $json->shootingDate, $json->deliveryDate);

    }

    echo json_encode($data);

?>