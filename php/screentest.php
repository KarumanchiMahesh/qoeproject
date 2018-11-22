<!DOCTYPE html> 
<?php
include("dbinfo.inc.php");
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$id = $_POST['id'];

$tmp = $dbname . ".screentest";
$Score = $_POST['Score'];
if ($Score > 5) {
        header('HTTP/1.0 403 Forbidden');}
}
else{
 

    $Lowest = $_POST['Lowest'];
    $Highest = $_POST['Highest'];
    
    $Score = $_POST['Score'];
    $stars = array_fill(1, 8, false);

 /*   for ($i = 1; $i <= 8; $i++) {
        if (!(empty($_POST['Star' . $i]))) {
            $stars[$i] = TRUE;
        }
    }
*/
    $Time = $_POST['Time'];
    $ClickNum = $_POST['ClickNum'];

    $sql = "INSERT INTO " . $tmp .
            "(Name,Lowest,Highest,Star1,Star2,Star3,Star4,Star5,Star6,Star7,Star8,Time,ClickNum,Score)" .
            "VALUES('$id','$Lowest','$Highest','$stars[1]','$stars[2]','$stars[3]','$stars[4]','$stars[5]','$stars[6]','$stars[7]','$stars[8]','$Time','$ClickNum','$Score')";

    $result = $conn->query($sql) or die('Could not enter data: ' . mysqli_error());

 }
    
}
mysqli_close($conn);
?>
