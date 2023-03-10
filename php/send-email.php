<?php

    function SendEmail($to, $subject, $message) {

        // $header = "From: OleriaWeb@gmail.com";

        // if (mail($to, $subject, $message, $header)) {
        //     return true;
        // }
        // else {
        //     return false;
        // }

        $i = 0;
        $fileName = "$i.txt";

        while (file_exists("$fileName.txt")) {
            $i++;
            $fileName = "$i.txt";
        }

        $file = fopen($fileName, "w");
        $data = "To: $to, Subject: $subject, message: $message";
        fwrite($file, $data);

    }

    function SendHTMLEmail($to, $subject, $message) {

    }

?>