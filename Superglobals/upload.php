<?php
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776); // declare these constants to help do file size calculations since PHP works in bytes

if (isset($_POST["submit"])){
    $file = $_FILES['file'];
    $name = $_FILES['file']['name']; // find file name
    $tmp_name = $_FILES['file']['tmp_name']; //temp loc  **** WHY DO WE NEED TEMP STORAGE?
    $size = $_FILES['file']['size']; // find file size
    $error = $_FILES['file']['error']; // find errors

    //explode from puncuation mark
    $tempExtension = explode('.', $name);

    $fileExtension = strtolower(end($tempExtension)); // takes tempExtension and puts it to lower case to prevent errors because we do not want caps for your file ext

    //allowed extensions
    $isAllowed = array('jpg', 'jpeg', 'png', 'pdf'); 
    
    // 0 = no error - 1 = error
    if (in_array($fileExtension, $isAllowed)){
        if ($error === 0) {
            if ($size < 3*MB) {     //2.3 mb is avg image size so i will set this to 3MB  see above constants
                $newFileName = uniqid('', true) . "." . $fileExtension; // gives unique id and then a .  and then the file extension ex. id.jpg
                $fileDestination = "uploads/" . $newFileName; // saves to folder
                move_uploaded_file($tmp_name, $fileDestination);//save to temp location
                header("Location: files.php?uploadedsuccess"); //redirect and success

            } else {
                echo "Sorry, your file is too big! Please use a file less than 3MB ";
            }

        } else{
            echo "Sorry, there was an error. Please try again";
        }
         
        } else {
            echo "Sorry, your file type is not accepted. Please use jpg, jpeg, png or pdf files only.";
        }
    }

?>