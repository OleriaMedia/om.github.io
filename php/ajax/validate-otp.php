<?php

    include_once "../db.php";
    include_once "../functions.php";
    include_once "../send-email.php";
    
    session_start();

    function AddUser($name, $email, $password, $phone_num) {

        global $conn;
    
        // Prepare And Execute A Statement
        $query = "INSERT INTO Users (NAME, EMAIL, PASSWORD, PHONENUMBER)
        VALUES (?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->execute([$name, $email, $password, $phone_num]);

        // Get The Users ID
        $userID = $conn->lastInsertId();

        return $userID;

    }

    
    $data = [];
    $json = json_decode(file_get_contents("php://input"));

    $originalOTP = $json->otp;
    $hashedOTP = $_SESSION["hashed-otp"];
    $otpExpirationTime = $_SESSION["otp-exp"];
    $currentTime = time();

    if ($currentTime > $otpExpirationTime) {
        // Has Expired
        $data["success"] = FALSE;
        $data["error"] = "کد تایید منقضی شده، کد جدید به ایمیل فرستاده شد!";

        SendNewOTP();

    } elseif (!password_verify($originalOTP, $hashedOTP)) {
        // OTPs Dont Match!
        $data["success"] = FALSE;
        $data["error"] = "کد تایید درست نیست!";
        
    } else {
        // Everything is Fine!
        $data["success"] = TRUE;

        // Add The User To The Database
        $_SESSION["id"] = AddUser($_SESSION["username"], $_SESSION["email"], $_SESSION["password"], $_SESSION["phone-number"]);
        $_SESSION["is-logged-in-to-oleria"] = TRUE;


    }

    $data["remainingTime"] = $_SESSION["otp-exp"] - time();

    echo json_encode($data);

?>