<?php

    include_once "../db.php";

    session_start();

    function GetUserDataWithPhoneNumber($phoneNumber) {

        global $conn;

        $query = "SELECT * FROM Users WHERE PHONENUMBER = ?";
        $statement = $conn->prepare($query);
        $statement->execute([$phoneNumber]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    $data = [];
    $errors = [];

    $json = json_decode(file_get_contents("php://input"));
    $userData = GetUserDataWithPhoneNumber($json->phoneNumber);

    if (empty($userData)) {
        // There Were No Rows With That Phone Number
        $data["success"] = FALSE;
        $errors["phoneNumber"] = "شماره تلفن درست نیست!";
    } elseif (!password_verify($json->password, $userData["PASSWORD"])) {
        // Password And Hash Dont Match!
        $data["success"] = FALSE;
        $errors["password"] = "رمز ورود درست نیست!";
    } else {
        // Password And Hash Match!
        $data["success"] = TRUE;
        $_SESSION["id"] = $userData["ID"];
        $_SESSION["is-logged-in-to-oleria"] = TRUE;
    }

    if (!empty($errors)) {
        $data["errors"] = $errors;
    }
    echo json_encode($data);

?>