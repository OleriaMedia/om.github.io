<?php

    include_once "../../db.php";
    include_once "../../is-logged-in.php";

    function AddNewPhotographyOrder($numberOfPhotos, $city, $photoType, $whatsAppNumber, $time) {

        global $conn;

        $userID = $_SESSION["id"];
        date_default_timezone_set("Iran");

        $date = date("Y/m/d H:i:s");

        $query = "INSERT INTO 
        PhotographyProjects (USERID, NUMBEROFPHOTOS, CITY, PHOTOTYPE, WHATSAPPNUMBER, TIME, SUBMITTIME)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->execute([$userID, $numberOfPhotos, $city, $photoType, $whatsAppNumber, $time, $date]);

    }

    $data = [];

    $json = json_decode(file_get_contents("php://input"));
    
    if (!IsLoggedIn()) {

        $data["success"] = FALSE;

    } else {

        $data["success"] = TRUE;
        AddNewPhotographyOrder($json->numberOfPhotos, $json->city, $json->photoType, $json->whatsAppNumber, $json->time);

    }

    echo json_encode($data);

?>