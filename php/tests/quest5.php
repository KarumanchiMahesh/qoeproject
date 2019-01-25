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

$res = $conn->query("select * from tasks_completed where subject_id=".$id);
 if ($res->num_rows>0){
    while($row=$res->fetch_assoc()){
        $count = $row['count'];
        $token_no = $row['token_no'];
    }
}
if ($token_no%14==0){
    $vid_id=14;
}
else{
    $vid_id=($token_no)%14;
}
//load the question 
$res = $conn->query("select * from video_storage where id=".$vid_id);
if ($res->num_rows>0){
    while($row=$res->fetch_assoc()){
        $question = $row['question'];
        $option1 = $row['option1'];
        $option2 = $row['option2'];
        $option3 = $row['option3'];
        $correct = $row['correct'];
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
 <h2>Question</h2>
 <span id="error">
 <!---- Initializing Session for errors --->
 <?php
 if (!empty($_SESSION['error'])) {
 echo $_SESSION['error'];
 unset($_SESSION['error']);
 }
 
 ?>
 </span>
 <form action="" name = "myForm" id="form" method="post" required>
 <label><?php echo $question;?></label><br />
 <input type="radio" name="answer" value="3" required><?php echo $option1;?><br />
 <input type="radio" name="answer" value="2"><?php echo $option2;?><br />
 <input type = "radio" name="answer" value="1"><?php echo $option3;?><br />
 <br />
 <input type="submit" value="Next" name="submit" onclick = "submitForm()" />
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
                $answer  = $_POST['answer'];//unlock or lock update the answer and pageposition
                $res = $conn->query("update temporary_data set ansrec5="."'".$answer."'".",question5="."'".$question."'".",correct5="."'".$correct."'"." where subject_id="."'".$id."'");
                
             //update page position 
                $pagepos = 'quest1' ;
                $res = $conn->query("update tasks_completed set pagepos="."'".$pagepos."'"." where subject_id="."'".$id."'");
                if ($res){
                    $res = $conn->query("select token_no,form5 from tasks_completed where subject_id=".$id);
                    if ($res->num_rows>0){
                        while($row=$res->fetch_assoc()){
                            $token_no = $row['token_no'];
                            $lock = $row['form5'];
                        }
                    }
            
                    if ($lock=="unlock"){
                        if ($count==1){
                            $count=2;
                        }
                        else if ($count==2){
                            $count=3;
                        }
                        else if($count==3){
                            $count=4;
                        }
                        else if ($count==4){
                            $count=5;
                        }
                        else if ($count==5){
                            $count=6;
                        }
                        else if ($count==6){
                            //move to end page
                            $count=7;
                        }
                        
                        $res = $conn->query("update `tasks_completed` set `count`=".$count." where subject_id=".$id);
                        
                        if ($count==7){
                            
                            $loc = '../end';
                        }
                        else{
                        $location = 'loc'.$count;
                        $res = $conn->query("select * from video_randomiser where id=".$token_no);
                        if ($res->num_rows>0){
                            while($row=$res->fetch_assoc()){
                                $loc = $row[$location];
                            }
                        }}
                        
                        //save next location,lock the count
                        $res = $conn->query("update tasks_completed set `next5`="."'".$loc."'".",`form5`="."'"."lock"."'"." where subject_id=".$id );
                        //load next location
                        header('location: '.$loc.'.php?id='.$id);
                       
                    }
                    else{
                        //don't count
                        //move to next location using saved location
                        $res = $conn->query('select next5 from tasks_completed where subject_id='.$id);
                        if ($res->num_rows>0){
                            while($row = $res->fetch_assoc()){
                                $next = $row['next5'];
                            }
                        }
                        header('location: '.$next.'.php?id='.$id); 
                    }
                }
        }    
                
                
                
        
            
        

        ?>
    </body>
</html>

