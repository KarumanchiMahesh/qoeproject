<?php
session_start();
include("dbinfo.inc.php");
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$id = $_GET['id'];

//check if user exists or not
$res = $conn->query("select * from tasks_completed where subject_id=".$id);
if ($res->num_rows>0){
    //evaluate 
    $res = $conn->query("select * from temporary_data where subject_id=".$id);
    while($row=$res->fetch_assoc()){
        $ans1 = $row['ansrec1'];
        $ans2 = $row['ansrec3'];
        $ans3 = $row['ansrec5'];
        $correct1 = $row['correct1'];
        $correct2 = $row['correct3'];
        $correct3 = $row['correct5'];
    }
    $count = 0;
    if ($ans1==$correct1){
        $count+=1;
    }
    if ($ans2 == $correct2){
        $count+=1;
    }
    if ($ans3==$correct3){
        $count+=3;
    }
    if ($count>1){
        //update status
        $vid1count=$_SESSION['views1'];
        $vid2count = $_SESSION['views2'];
        $vid3count = $_SESSION['views3'];
        $vid4count = $_SESSION['views4'];
        $vid5count = $_SESSION['views5'];
        $vid6count = $_SESSION['views6'];
        
        
        $res = $conn->query('update `tasks_completed` set `status`='."'"."success"."'"." where subject_id=".$id);
        $res = $conn->query('update `temporary_data` set `vid1count`='."'".$vid1count."'".", vid2count=".$vid2count.",vid3count=".$vid3count.",vid4count=".$vid4count.",vid5count=".$vid5count.",vid6count=".$vid6count." where subject_id=".$id);
        session_destroy();
        $res = $conn->query('insert into results select * from temporary_data where subject_id='.$id);
        header('location: testpass.php?id='.$id);

        
    }
    else if ($count<2){
        //update status
        $res = $conn->query('update `tasks_completed` set `status`='."'"."failed"."'"." where subject_id=".$id);
        header('location:testfail.php?id='.$id);
    }

}    
else{//check if user exists or not

    echo "<p> Your id does not exist in our database</p>";
}   
        
?>
