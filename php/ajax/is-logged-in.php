<?php

    include_once "../is-logged-in.php";

    $data = ["isLoggedIn" => IsLoggedIn()];

    echo json_encode($data);

?>