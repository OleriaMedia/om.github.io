<?php

    include_once "../functions.php";
    include_once "../send-email.php";

    session_start();

    $data = [];

    $expirationTime = $_SESSION["otp-exp"];
    $currentTime = time();

    if ($currentTime > $expirationTime) {
        // OTP Has Expired, Send A New One

        $data["message"] = "کد تایید منقضی شده، کد جدید به ایمیل فرستاده شد!";

        SendNewOTP();
        $expirationTime = $_SESSION["otp-exp"];
        $currentTime = time();
    }

    $remainingTime = $expirationTime - $currentTime;

    $data["seconds"] = $remainingTime;

    echo json_encode($data);

?>