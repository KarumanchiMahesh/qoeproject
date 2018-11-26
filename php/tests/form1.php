<?php
session_start();
$trailvid1 = $_SESSION['trailvid1'];
echo $trailvid1;?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Evaluation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link rel="icon" type="image/ico" href="../img/icon.ico"> 
        <link rel="stylesheet" href="../css/styles.css" />
    </head>

    <body>

        <div align ="right">
            <br/>	
            <button  type="button" id ="Instruction" class="btn btn-warning" style="margin-right: 100px;width:100px;height:30px;" onClick="window.open('../instruction/instruction.php#videotest')">Instructions</button>
        </div>

<div class="container" >
 <div class="main">
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
 <form action="" method="post">
 <label>Give rating to video from Excellent to Bad</label>
 <input type="radio" name="rating" value="5" required>Excellent
 <input type="radio" name="rating" value="4">Fair
 <input type = "radio" name="rating" value="3">Good
 <input type="radio" name="rating" value="2">Poor
 <input type="radio" name="rating" value="1">Bad
 <br>
 <input type="reset" name="Reset" />
 <input type="submit" value="Next" />
 </form>
 </div>
 </div>

      </body>

            <?php
            include("../dbinfo.inc.php");
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

            $id = $_GET['id'];

            

            // Current test
           /* $tmp = $dbname . ".subjects";
            $next = $conn->query("SELECT * FROM $tmp WHERE Name='$id'")->fetch_object()->Next;

            $test_id = $conn->query("SELECT test_id$next FROM $tmp WHERE Name='$id'")->fetch_row();

            $q1_pos = $conn->query("SELECT * FROM $tmp WHERE Name='$id'")->fetch_object()->q1_pos;
            $q2_pos = $conn->query("SELECT * FROM $tmp WHERE Name='$id'")->fetch_object()->q2_pos;
            $q3_pos = $conn->query("SELECT * FROM $tmp WHERE Name='$id'")->fetch_object()->q3_pos;

            if ($q1_pos == $next) {
                $pair_id = $conn->query("SELECT Pairing_id".$next." FROM $tmp WHERE Name='$id'")->fetch_row();
                $tmp = $dbname . ".pairings";
                $question = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Question;
                $answer1 = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Answer1;
                $answer2 = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Answer2;
                $answer3 = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Answer3;
                $correct = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Correct;
            } else if ($q2_pos == $next) {
                $pair_id = $conn->query("SELECT Pairing_id".$next." FROM $tmp WHERE Name='$id'")->fetch_row();
                $tmp = $dbname . ".pairings";
                $question = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Question;
                $answer1 = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Answer1;
                $answer2 = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Answer2;
                $answer3 = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Answer3;
                $correct = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Correct;
            } else if ($q3_pos == $next) {
                $pair_id = $conn->query("SELECT Pairing_id".$next." FROM $tmp WHERE Name='$id'")->fetch_row();
                $tmp = $dbname . ".pairings";
                $question = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Question;
                $answer1 = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Answer1;
                $answer2 = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Answer2;
                $answer3 = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Answer3;
                $correct = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$pair_id[0]'")->fetch_object()->Correct;
            }


            $next2 = $next + 1;
            if ($next < 9) {
                $tmp = $dbname . ".subjects";
                $next_pair = $conn->query("SELECT Pairing_id".$next2." FROM $tmp WHERE Name='$id'")->fetch_row();
                $tmp = $dbname . ".pairings";
                $vid1 = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$next_pair[0]'")->fetch_object()->Video_id1;
                $vid2 = $conn->query("SELECT * FROM $tmp WHERE Pairing_id='$next_pair[0]'")->fetch_object()->Video_id2;
            } else {
                $next_pair = "";
                $vid1 = "";
                $vid2 = "";
            }*/

          //  mysqli_close($conn);

         /*   if (isset($question)) {
                echo "<br/>
                <h2>$question</h2>
                <br/>
                <form id='dummyform'>
                    <input type='radio' name='dummy' value='1'>$answer1<br>
                    <input type='radio' name='dummy' value='2'>$answer2<br>
                    <input type='radio' name='dummy' value='3'>$answer3
                </form>

                <br/>
                <br/>";
            } else {
                $correct = 0;
            }*/
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
        <?php

        if ($_POST['rating']!=''){

        //send the received data to temporary_data

            $rating  = $_POST['rating'];

            $sql = "update temporary_data set trailvid1rating="."'".$rating."'"." where subject_id="."'".$id."'";

            $res = $conn->query($sql);

            if ($res){
                echo "success";
            }
        //update page position 
            $pagepos = 'form1.php' ;
            $sql = "update tasks_completed set pagepos="."'".$nextpage."'"." where subject_id="."'".$id."'";
            $res = $conn->query($sql);
            if ($res){
                echo "success";
            }

        //move to next page
            header('location:trailvid2.php?id='.$id);

        }    


            
    
        ?>
    </body>
</html>

