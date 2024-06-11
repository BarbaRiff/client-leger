<?php 
    $db_connec = mysqli_connect("localhost", "root", "", "motion_case", 3306);
    $db_connec->set_charset("utf8");
    if (!$db_connec) {
        die("Connection failed: " . mysqli_connect_error());
    }

            