<?php
include('../dbinfo.inc.php');
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$id = $_GET['id'];
?>
<!doctype html>
<html>
    <head>
        <title>
            Description before trail videos
        </title>
    </head>
    <body>
        <div>
            <p>Instructions
        </div>
        <div style="text-align:center;">
            <input type="button" onclick="window.location.href='<?php echo "trailvid1.php?id=".$id;?>'" value="Start">
        </div>   
    </body>
</html>     


