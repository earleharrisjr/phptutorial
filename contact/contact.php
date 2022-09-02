<?php

if(isset($_POST['submit'])) {  // checks for submit and method of post to do something
    $name = trim($_POST['name']); //this will set variable name to the 'name" input field from user when submitted. trim function is good contact forms and log in systems. will remove white spaces on left and right. 
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    $myMail = "eeharrisjr@gmail.com"; //email you are sending it to
    $header = "From: " . $email;
    $messsage2= "You have receive a message from " . $name . ". \n\n";

    //1. email you are sending it to
    //2. subject
    //3. message
    mail($myMail, $subject, $message2, $header); //this will send email BUT will not work with GMAIL 

    header("Location: index.php?mailsend"); // redirect to this page once form is submitted
}

?>