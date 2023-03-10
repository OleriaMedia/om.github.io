<?php

    session_start();

    function IsLoggedIn() {

        if (empty($_SESSION["is-logged-in-to-oleria"]) or $_SESSION["is-logged-in-to-oleria"] === FALSE or empty($_SESSION["id"])) {
            return false;
        } else {
            return true;
        }

    }

?>