<?php

//below are you params to connect to database
$dbHost = "localhost"; // if you are using a web server you need to change this to host you are using
$dbUser = "root"; // since we are using xamp the default is root
$dbPass = ""; // we are not using a password since default in xamp is empty. there should be a password when you host this online
$dbName = "phptutorial"; // this will be name of the database you are using. we called ours phptutorial for this 

//connection to database
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName); //my sqli is for "improved" and will do more things vs mysql. Just an improved version. 


// this if statement will check if we can connect to database
if (!$conn) {
    die("Database connection failed!");
}


?>