<?php

    // Username Email Password PhoneNumber

    session_start();

    include_once "../db.php";
    include_once "../functions.php";
    include_once "../send-email.php";

    $errorMessage = "";
    $output = "";
    $data = [];
    $errors = [];

    $json = json_decode(file_get_contents("php://input"));
    
    // Username
    if (ValidateUsername($json->username)) {
        $errors["username"] = $errorMessage;
    } else {
        $json->username = $output;
    }

    // Email
    if (ValidateEmail($json->email)) {
        $errors["email"] = $errorMessage;
    } else {
        $json->email = $output;
    }

    // Password
    if (ValidatePassword($json->password)) {
        $errors["password"] = $errorMessage;
    } else {
        $json->password = $output;
    }

    // Phone Number
    if (ValidatePhoneNumber($json->phoneNumber)) {
        $errors["phoneNumber"] = $errorMessage;
    } else {
        $json->phoneNumber = $output;
    }

    if (!empty($errors)) {
        // If There Are Errors
        $data["success"] = FALSE;
        $data["errors"] = $errors;

    } else {

        // If There Are No Errors
        $data["success"] = TRUE;

        // Hash The Password
        $json->password = HashPassword($json->password);

        // Store The Data In The Session
        $_SESSION["username"] = $json->username;
        $_SESSION["email"] = $json->email;
        $_SESSION["password"] = $json->password;
        $_SESSION["phone-number"] = $json->phoneNumber;

        // Generate An OTP
        $otp = GenerateOTP(6);
        $expirationTime = time() + (2 * 60);
        $_SESSION["hashed-otp"] = HashPassword($otp);
        $_SESSION["otp-exp"] = $expirationTime;
        
        // Send An Email With OTP
        $message = "کد تایید شما $otp میباشد!";
        SendEmail($json->email, "کد تایید...", $message);

    }

    echo json_encode($data);
    

    function ValidateUsername($name) {

        global $minNameLength, $maxNameLength, $persianLetterPattern, $errorMessage, $output;

        $name = Sanitize($name); // Sanitize

        if (empty($name)) { // Check for emptiness
            $errorMessage = "نام خالی است!";
            return true;
        }
        elseif (strlen($name) < $minNameLength) { // Length Check
            $errorMessage = "نام کوتاه است!";
            return true;
        }
        elseif (strlen($name) > $maxNameLength) {
            $errorMessage = "نام طولانی است!";
            return true;
        }

        $numberOfMatches = preg_match_all($persianLetterPattern, $name);

        if ($numberOfMatches != 0) {
            $errorMessage = "نام فقط حروف فارسی و فاصله باشد!";
            return true;
        }
        else {
            $output = $name;
            return false;
        }
    }

    function ValidateEmail($email) {

        global $minEmailLength, $maxEmailLength, $errorMessage, $output;

        $email = Sanitize($email); // Sanitize

        if (empty($email)) {
            $errorMessage = "ایمیل خالی است!";
            return true;
        }
        elseif (strlen($email) < $minEmailLength) {
            $errorMessage = "ایمیل کوتاه است!";
            return true;
        }
        elseif (strlen($email) > $maxEmailLength) {
            $errorMessage = "ایمیل طولانی است!";
            return true;
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = "ایمیل درست نیست!";
            return true;
        }
        else {
            $output = $email;
            return false;
        }

    }

    function ValidatePassword($pass) {

        global $minPassLength, $maxPassLength, $errorMessage, $output;

        $pass = Sanitize($pass); // Sanitize

        if (empty($pass)) { // Check for emptiness
            $errorMessage = "رمز ورود خالی است!";
            return true;
        }
        elseif (strlen($pass) > $maxPassLength) {
            $errorMessage = "رمز ورود طولانی است!";
            return true;
        }
        elseif (strlen($pass) < $minPassLength) {
            $errorMessage = "رمز ورود کوتاه است!";
            return true;
        }
        else {
            $output = $pass;
            return false;
        }
    }

    function ValidatePhoneNumber($phone) {

        global $errorMessage, $output;

        $phone = Sanitize($phone); // Sanitize

        if (empty($phone)) { // Check for emptiness
            $errorMessage = "شماره خالی است!";
            return true;
        } elseif (!preg_match("/09[0-9]{9}/", $phone) or strlen($phone) != 11) {
            $errorMessage = "شماره درست نیست!";
            return true;
        } else {
            $output = $phone;
            return false;
        }
    }

    function Sanitize($input) {
        $input = stripslashes($input);
        $input = trim($input);
        $input = htmlspecialchars($input);
        return $input;
    }

?>