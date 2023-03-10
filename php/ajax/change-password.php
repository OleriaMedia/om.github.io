<?php

    include_once "../functions.php";
    include_once "../db.php";

    session_start();

    function ChangePasswordForUserWithEmail($email, $hashedPassword) {

        global $conn;

        $query = "UPDATE Users SET PASSWORD = ? WHERE EMAIL = ?";
        $statement = $conn->prepare($query);
        $statement->execute([$hashedPassword, $email]);        

    }

    $data = [];
    $errors = [];

    $json = json_decode(file_get_contents("php://input"));

    if (empty($_SESSION["change-password-key-hashed"]) or empty($_SESSION["email"])) {
        // Required Session Variables Are Empty!
        $data["success"] = FALSE;
    } elseif (!password_verify($json->key, $_SESSION["change-password-key-hashed"])) {
        // Keys Dont Match!
        $data["success"] = FALSE;
    } else {
        // Keys Match, Can Change Password!
        $data["success"] = TRUE;
        ChangePasswordForUserWithEmail($_SESSION["email"], HashPassword($json->newPassword));
    }

    echo json_encode($data);

?>