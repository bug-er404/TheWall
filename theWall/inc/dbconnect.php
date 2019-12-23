<?php
/*
 * CONNECTING TO THE DB
 */
try {
    $db = new PDO("mysql:host=localhost; dbname=smaharj_project;port=3366", "smaharj_admin", "Notmypassword19");
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $db -> exec()
} catch(Exception $e){
    echo "Error connecting to database!";

}
