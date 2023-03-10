<?php

    include_once "../send-email.php";
    include_once "../db.php";
    include_once "../functions.php";

    session_start();

    function UserWithEmailExists($email) {

        global $conn;

        $query = "SELECT * FROM Users WHERE EMAIL = ?";
        $statement = $conn->prepare($query);
        $statement->execute([$email]);
        $numberOfRows = $statement->rowCount();

        if ($numberOfRows == 0) {
            return false;
        } else {
            return true;
        }

    }

    $data = ["success" => TRUE, "message" => "ایمیل خود را چک کنید..."];
    $errors = [];

    $emailAddress = json_decode(file_get_contents("php://input"))["email"];

    if (UserWithEmailExists($emailAddress)) {

        // Make A Key
        $key = GenerateOTP(50);
        // Put It In The Session
        $_SESSION["email"] = $emailAddress;
        $_SESSION["change-password-key-hashed"] = HashPassword($key);
        // Put It In A Link
        $httpHost = $_SERVER["HTTP_HOST"];
        $link = "$httpHost/registration/change-password/?key=$key";
        // Email The Link To That Email Address
        $message = "برای تغییر رمز ورود خود به این آدرس بروید: $link";
        SendEmail($emailAddress, "تغییر رمز ورود", $message);
    }

    echo json_encode($data);

?>