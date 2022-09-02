<?php

if (isset($_POST['submit'])) {  //checking to see if the user clicks submit
    //add database connection
    require 'database.php';

    //set variables based on inputs  on register page
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPassword'];

    if(empty($username) || empty($password) || empty($confirmPass)) { //check if variable is empty / null
        header("Location: ../register.php?error=emptyfields&username=".$username); // redirects. the ../ takes us back step back in our directory. the &username= part will make sure the user does not have to re enter their username
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*/","$username")) { //searches in a string in a pattern.  takes two params search param and where you want to searchs. This is going to let us set what chars you want in the username
        header("Location: ../register.php?error=invalidusername&username=".$username); // Simular to above. will let user know username is not valid
        exit();
    } elseif ($password !== $confirmPass) { //error message if the password and confirm password are not equal
        header("Location: ../register.php?error=passwordsdonotmatch&username=".$username); //still sends back username since the username would be valid
        exit();
    } else {
        $sql = "SELECT username FROM users WHERE username = ?"; //we are checking to see if username already exist in database. We are using a prepared statement (the ?) to prevent people from messing up our database.
        $stmt = mysqli_stmt_init($conn); // initializes the statement. takes one param which is our database connection
        if (!mysqli_stmt_prepare($stmt, $sql)){ //checking "to see if this function fails
            header("Location: ../register.php?error=sqlerror"); 
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username); // this will bind params. letter "s" is for string. i is for intiger and b is for boolean. You can add additonal letters all inside same double quotes for additional. Username is the string we are checking.  
            mysqli_stmt_execute($stmt); //statement you want to execute
            mysqli_stmt_store_result($stmt); //this will take result from database and store it in STMT
            $rowCount = mysqli_stmt_num_rows($stmt); //will be 0 or 1. 1 if the username already exist

            if($rowCount > 0){
                header("Location: ../register.php?error=usernametaken"); //gives error for username already taken
                exit();
            } else {
                $sql = "INSERT INTO users (username, password) VALUES (?, ?)"; //create username in database using prepared statement (see above explanation regarding the ?)
                $stmt = mysqli_stmt_init($conn); // initializes the statement. takes one param which is our database connection
                if (!mysqli_stmt_prepare($stmt, $sql)){ //checking "to see if this function fails
                    header("Location: ../register.php?error=sqlerror"); 
                    exit();
                } else {
                    $hashedPass = password_hash($password, PASSWORD_DEFAULT); //this will has our password. first param is the password variable we are passing in and the 2nd is how we are hashing it. MP5 and MP7 are common methods but outdated. We will use vcrypt since it is updated often

                    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPass); // this will bind params. letter "s" is for string. i is for intiger and b is for boolean. You can add additonal letters all inside same double quotes for additional. Username is the string we are checking.  
                    mysqli_stmt_execute($stmt); //statement you want to execute
                    header("Location: ../register.php?success=registered"); 
                    exit();            
                }
            }
        }
    }
    mysqli_stmt_close($stmt); //closes connection  statement. Not needed because it automatical does it but this will save resources by doing it ourselves.takes one variable and it is the stmt we created
    mysqli_close($conn); // closes connection to database like above
}

?>