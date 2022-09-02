<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
</head>
<body>
<?php

// below if statement operates the HTML form below. (see input type submit on bottom form)
if (isset($_POST['submit'])){
    $myFile = fopen("uploads/file.txt", "a"); //create  file "w" is the parameter for fopen. See php docs for other f open parameters. w will over ride every time you submit. a will add on these to the text.

    $txt = "$_POST['age'] . '\n'";  //what we are going to write the forward slash N is a line break

    fwrite($myFile, $txt); //f write takes the file name as first parameter and  second parameter will be the variable for txt you wish to write. 

    fclose($myFile); // closes file you are writing
}


?>

<form class="form" action="fileput.php" method="post">
    <input type="text" name="age">
    <input type="submit" name="submit">
</form>



</body>
</html>