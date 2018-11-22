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
    </head>

    <body>

        <div align ="right">
            <br/>	
            <button  type="button" id ="Instruction" class="btn btn-warning" style="margin-right: 100px;width:100px;height:30px;" onClick="window.open('../instruction/instruction.php#videotest')">Instructions</button>
        </div>
<h1>
        Give Rating to this Video
    </h1>
</div>
      <div>  <form class = "test-video" action="" method="post" required>
      <table>
        <th></th>
        <th>
          <tr><td>Give Rating to this video from 5 to 1:</td></tr>
        </th>
        <tr>
          <td><input type="radio" name="rating" value="5" required>Excellent</td>
        </tr>
        <tr>
          <td><input type="radio" name="rating" value="4">Good</td>
        </tr>
        <tr>
          <td><input type="radio" name="rating" value="3">Fair</td>
        </tr>
        <tr>
          <td><input type="radio" name="rating" value="2">Poor</td>
        </tr>
        <tr>
          <td><input type="radio" name="rating" value="1">Bad</td>
        </tr>
        <tr>
          <td><input type="submit" value="submit" name="submit"></td>
      </tr>

      </table>
  </div>
</form>
</div></body>

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

            $sql = "update temporary_data set vid6rating="."'".$rating."'"." where subject_id="."'".$id."'";

            $res = $conn->query($sql);

            if ($res){
                echo "success";
            }
        //update page position 
            $nextpage = 17;
            $sql = "update tasks_completed set pagepos="."'".$nextpage."'"." where subject_id="."'".$id."'";
            $res = $conn->query($sql);
            if ($res){
                echo "success";
            }

        //move to next page
        
        // check whether user given atleast 2 right answers 

        $sql = 'select * from temporary_data where subject_id='.$id;

        $res = $conn->query($sql);

        if ($res->num_rows>0){
            while ($row=$res->fetch_assoc()){
                $correct1 = $row['correct1'];
                $correct2 = $row['correct3'];
                $correct3 = $row['correct5'];
                $ansrec1 = $row['ansrec1'];
                $ansrec2 = $row['ansrec3'];
                $ansrec3 = $row['ansrec5'];
            }
        }
        $correct = 0;
        if ($correct1==$ansrec1){
            $correct = $correct + 1;
        }
        if ($correct2==$ansrec2){
            $correct = $correct + 1;
        }
        if ($correct3==$ansrec3){
            $correct = $correct + 1;
        }

        $sql = "update temporary_data set receivedcorrectans="."'".$correct."'"." where subject_id="."'".$id."'";
        $res = $conn->query($sql);
        if ($correct<2){
            header('location:../errors/testfail.php?id='.$id);

        }
        else{



            header('location:../end.php?id='.$id);

        }   
        } 


            
    
        ?>
    </body>
</html>

