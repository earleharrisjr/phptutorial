<?php

if (isset($_POST['submit'])) {

    require 'database.php';
        //set variables based on inputs  on register page
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (empty($username) || empty($password)){
            header("Location: ../index.php?error=emptyfields"); // redirects. the ../ takes us back step back in our directory. the &username= part will make sure the user does not have to re enter their username
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=sqlerror"); // redirects. the ../ takes us back step back in our directory. the &username= part will make sure the user does not have to re enter their username
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) { //check password 
                    $passCheck = password_verify($password, $row['password']);
                    if ($passCheck == false) {
                        header("Location: ../index.php?error=wrongpassword"); //
                        exit();
                    } elseif ($passCheck == true) { //this will be the log into website
                        session_start();
                        $_SESSION['sessionId'] = $row["id"];
                        $_SESSION['sessionUser'] = $row["username"]; // we of course would not use password since is it sensative info
                        header("Location: ../index.php?success=loggedin"); 
                    } else {
                        header("Location: ../index.php?error=wrongpassword"); // this is an extra step for security. same as the first if
                        exit();
                    }
                } else {
                    header("Location: ../index.php?error=nouser"); // redirects. the ../ takes us back step back in our directory. the &username= part will make sure the user does not have to re enter their username
                    exit();
                }
            }
        }


} else {
    header("Location: ../index.php?error=accessforbidden"); // redirects. the ../ takes us back step back in our directory. the &username= part will make sure the user does not have to re enter their username
    exit();
}

?>