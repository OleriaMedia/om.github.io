<?php

    $phoneNumberPattern = "/09[^0-9]/";
    $persianLetterPattern = "/[^آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهی ]/ui";

    // Variable Length
    $minNameLength = 6;
    $maxNameLength = 30;

    $minPassLength = 8;
    $maxPassLength = 40;

    $minEmailLength = 6;
    $maxEmailLength = 60;
    

    function ValidateOTP($originalOTP, $otp) {

        global $errorMessage;

        if ($otp != $originalOTP) {
            $errorMessage = "کد درست نیست!";
            return true;
        }
        else {
            return false;
        }

    }

    function HashPassword($pass) {

        $options = ["cost" => 10];
        return password_hash($pass, PASSWORD_DEFAULT, $options);
    }

    function GenerateOTP($otp_len) {

        $numbers = "1357902468";

        $result = "";

        for ($i=0; $i < $otp_len; $i++) {
            $result .= substr($numbers, (rand()%(strlen($numbers))), 1);
        }

        return $result;

    }

    function SendNewOTP() {
        // Generate An OTP
        $otp = GenerateOTP(6);
        $expirationTime = time() + (2 * 60);
        $_SESSION["hashed-otp"] = HashPassword($otp);
        $_SESSION["otp-exp"] = $expirationTime;

        // Send An Email With OTP
        $message = "کد تایید شما $otp میباشد!";
        SendEmail($_SESSION["email"], "کد تایید...", $message);
        
    }

?>