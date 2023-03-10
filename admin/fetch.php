<?php

    include_once "../assets/php/db.php";

    function FetchAllRows($q) {

        global $conn;

        $stmt = $conn->query($q, PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

    }

    $q = $_GET["q"];

    echo var_dump(FetchAllRows($q));

?>