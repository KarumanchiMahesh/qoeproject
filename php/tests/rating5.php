<?php
include('../dbinfo.inc.php');
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$id = $_GET['id'];
$res = $conn->query('select status from tasks_completed where subject_id='.$id);
if ($res->num_rows>0){
    while($row=$res->fetch_assoc()){
        $status=$row['status'];
    }
    if ($status=='success'){
        header('location: ../testpass.php?id='.$id);
    }
    else if ($status=='failed'){
        header('location: ../testfail.php?id='.$id);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Evaluation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link rel="icon" type="image/ico" href="../img/icon.ico"> 
        <link rel="stylesheet" href="../css/styles.css" />
        <style>
            body {background-image:url('../img/low_contrast_linen.png');}
            input{color: white;}
            .container{width:400px;margin:0 auto;}
            .main{margin:200px;background-color:whitesmoke;}
        </style>
    </head>
    <body>
        <div align ="right">
            <br/>	
            <button  type="button" id ="Instruction" class="btn btn-warning" style="margin-right: 100px;width:100px;height:30px;" onClick="window.open('../instruction/instruction.php#videotest')">Instructions</button>
        </div>
<div class="container" style="width:600 px; margin: 0 auto;">
 <div class="main" style="width:500px; margin:50 auto;">
 <h2>Rating</h2>
 <span id="error">
 <!---- Initializing Session for errors --->
 <?php
 if (!empty($_SESSION['error'])) {
 echo $_SESSION['error'];
 unset($_SESSION['error']);
 }
 ?>
 </span>
 <form action="" method="post" name="myForm" id="form" required>
 <label>Give rating to video from Excellent to Bad</label><br />
 <input type="radio" name="rating" value="5" required>Excellent<br />
 <input type="radio" name="rating" value="4">Fair<br />
 <input type = "radio" name="rating" value="3">Good<br />
 <input type="radio" name="rating" value="2">Poor<br />
 <input type="radio" name="rating" value="1">Bad
 <br />
 <input type="submit" value="Next" name="submit" onclick="submitForm()" />
 </form>
 </div>
 </div>
      </body>
            <?php
            include("../dbinfo.inc.php");
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            $id = $_GET['id'];
            ?>
          <!--  <script>
                var html = '<video width="1" height="1" id="Video1" autoplay="true"><source src="../vids/<?php //echo 'test1' ?>.mp4" type="video/mp4"></video>';
                document.write(html);
                var html = '<video width="1" height="1" id="Video2" autoplay="true"><source src="../vids/<?php //echo 'test2' ?>.mp4" type="video/mp4"></video>';
                document.write(html);
            </script>
        </div>--> <!-- /container -->

        <script src="../js/jquery.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
        <script src="../js/bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
        function submitForm()
                    {
                        document.forms["myForm"].submit();
                        document.forms["myForm"].reset();
                    }
        </script>
        <?php

        if (isset($_POST['submit'])){

        //send the received data to temporary_data
            $rating  = $_POST['rating'];
            $res = $conn->query("update temporary_data set vid5rating="."'".$rating."'"." where subject_id="."'".$id."'");
         //update page position 
            $pagepos = 'rating1' ;
            $res = $conn->query("update tasks_completed set pagepos="."'".$pagepos."'"." where subject_id="."'".$id."'");
            if ($res){
                header('location:quest5.php?id='.$id);
            }
        }

        ?>
    </body>
</html>

