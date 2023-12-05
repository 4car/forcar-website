<?php
// Connect.php

    $servername = getenv("SERVERIP");
    $username = 'forcar';
    $pass = getenv("FORPASSWD");
    $dbname = 'forcar';

    $conn = new mysqli($servername, $username, $pass, $dbname);

    if ($conn->connect_error) {
        die("fail: " . $conn->connect_error);
    }
    //echo "<script>alert();</script>";
?>
