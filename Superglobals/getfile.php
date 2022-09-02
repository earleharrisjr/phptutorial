<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
</head>
<body>
<?php

$filePath = "uploads/file.txt";  // create variable for filePath

$output = file_get_contents($filePath);  // function file get contents takes one param, the file path and stores contents in variable output

$ages = explode("\n", $output ); //forward slash n is a line break. The explode function will seperate the ages at the breaks and put them into an array. 

$totalAge = 0;
$i = 0; //  had an error where i was getting one too many numbers  for the count. The issue was I had a blank line after all the numbers. This made it count one extra than the total I had and messed up average. 

foreach ($ages as $age) {   //function will print each age  in the ages array on a new line
    echo $age . "<br>";
    (float)$totalAge = (float)$totalAge + (float)$age; // next two lines will add ages for each iteration. Tutorial was differnt, needed to add INT before variables because it was trying to read one of them as a string for some reason
    $i++; 
};


echo "The average age is " . ($totalAge / $i); 

?>



</body>
</html>