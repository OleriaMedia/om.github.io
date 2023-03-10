<?php

    include_once "db-details.php";

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // function UserExistsLogin($phone_number, $password) {

    //     if ($conn->connect_error) { // Connection Error
    //         die("ارور! <br>" . $conn->connect_error);
    //     }
    //     else { // Connection Successful!

    //         // Prepare and bind a statement
    //         $statement = $conn->prepare("SELECT * FROM Accounts WHERE phonenumber = ?");
    //         $statement->bind_param("s", $phone_number);

    //         // Execute And Get The Result
    //         $statement->execute();
    //         $result = $statement->get_result();
    //         if ($result->num_rows < 1) {
                
    //             $this->error_msg = "شماره اشتباه است!";

    //             // Close The Connections
    //             $result->close();
    //             $statement->close();
    //             $conn->close();
    //             return false;
    //         }
    //         else {
    //             $row = $result->fetch_row();
    //         }
    //     }

    //     $hashed_pass = $row[3];

    //     if (password_verify($password, $hashed_pass)) {
    //         $this->output = $row;
    //         return true;
    //     }
    //     else {
    //         $this->error_msg = "رمز ورود اشتباه است!";
    //         return false;
    //     }

    // }

    // function UserExistsSignUp($email, $phone_number) {

    //     if ($conn->connect_error) { // Connection Error
    //         die("ارور! <br>" . $conn->connect_error);
    //     }
    //     else { // Connection Successful!

    //         // Prepare and bind a statement
    //         $statement = $conn->prepare("SELECT email, phonenumber FROM Accounts WHERE email = ? OR phonenumber = ?");
    //         $statement->bind_param("ss", $email, $phone_number);
            
    //         // Execute And Get The Result
    //         $statement->execute();
    //         $result = $statement->get_result();
    //         $number_of_rows = $result->num_rows;
    //     }

    //     if ($number_of_rows > 0) {
    //         $this->error_msg = "حسابی با این ایمیل و/یا شماره تلفن ثبت شده است!";
    //         return true;
    //     }
    //     else {
    //         return false;
    //     }

    // }

    // function ChangePasswordForUser($email, $new_password) {

    //     if ($conn->connect_error) {
    //         die("ارور! " . $conn->connect_error);
    //     }
    //     else {

    //         // Execute The Query
    //         $statement = $conn->prepare("UPDATE Accounts SET password = ? WHERE email = ?");
    //         $statement->bind_param("ss", $new_password, $email);
    //         $statement->execute();

    //     }

    // }

?>