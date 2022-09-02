
    <?php
require_once 'includes/header.php';
?>

<?php

if (isset($_SESSION['sessionId'])){
    echo "You are logged in ";
} else {
    echo "Home";
}

?>

<?php
require_once 'includes/footer.php';
?>






<!-- OLD CODE FROM FIRST EXERCISE CONNECTING TO DATA BASE
// $sql = "SELECT * FROM users"; //this is setting the value for the query
    // $result = mysqli_query($conn, $sql); // this function takes two params to check if sql can be performed, first one is connection. 2nd one is the query you want to perform
    // $rowCount = mysqli_num_rows($result); // checks to make sure that the query has something by pulling and counts the rows. takes 1 param and that is the query you wish to run

    // if ($rowCount > 0) {
    //     while($row = mysqli_fetch_assoc($result)) {  //function on this line returns an associative array that corresponds to fetched row until their are no more rows left. Takes one param for query you are looking for
    //         echo $row['username']. "<br>";
    //     }
    // }else{
    //     echo "No results found.";
    // }
     -->
