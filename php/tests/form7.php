<?php
session_start();

?>

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
        <div class>
        <h1>
        Give Rating to this Video
        </h1>
      </div>
      <div style="font-size:20px;">  
        <form class = "test-video" action="" method="post" required>
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
          

          </table>
        
      
  <?php
  include('../dbinfo.inc.php');
  $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
  $id = $_GET['id'];

  $sql = "select * from tasks_completed where subject_id=".$id;

  $res = $conn->query($sql);
  if ($res->num_rows>0){
    while ($row=$res->fetch_assoc()){
      $token_no = $row['token_no'];
    }
  }
  

  $task_id = ($token_no)%14;
  
  if ($task_id==0){
    $task_id=14;
  }
  $form_id = 5;
  $sql = 'select * from questions where taskid='.$task_id.' and '.'formid='.$form_id;
  

  $res = $conn->query($sql);
  
  if ($res->num_rows>0){
    while ($row=$res->fetch_assoc()){
        $question = $row['question'];
        $option3 = $row['option3'];
        $option2 = $row['option2'];
        $option1 = $row['option1'];
        $correct = $row['correct'];

    }

  }
  
  
  ?>
     
        <table>
        <th></th>
        <th>
          <tr><td><?php echo $question;?></td></tr>
        </th>
        <tr>
          <td><input type="radio" name="answer" value="3" required><?php echo $option1;?></td>
        </tr>
        <tr>
          <td><input type="radio" name="answer" value="2"><?php echo $option2;?></td>
        </tr>
        <tr>
          <td><input type="radio" name="answer" value="1"><?php echo $option3;?></td>
        </tr>
        
        <tr>
          <td><input type="submit" value="submit" name="submit"></td>
      </tr>

      </table>
      </form>
  </div>


<!--            <?php
            

        
            

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
            ?>-->



            
           
            

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
        
        if($_POST['rating']!=''&&$_POST['answer']!=''){
            $answer = $_POST['answer'];
            $rating = $_POST['rating'];
            $sql = "update temporary_data set question5="."'".$question."'".",correct5="."'".$correct."'".",ansrec5="."'".$answer."'".",vid5rating="."'".$rating."'"." where subject_id="."'".$id."'";
            $res = $conn->query($sql);
             if ($res){
                  echo "success";
              }
        
            $pagepos = 15;
            $sql2 = "update tasks_completed set pagepos="."'".$pagepos."'"." where subject_id="."'".$id."'";

            $res2 = $conn->query($sql2);
            if($res2){
              echo "success";
            }


              header('location:vid6.php?id='.$id);
        }?>                     

    </body>
</html>

