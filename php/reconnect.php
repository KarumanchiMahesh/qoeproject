<?php

include('dbinfo.inc.php');

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

$sql = 'select * from tasks_completed where id='.$id;

$res = $conn->query($sql);

if ($res->num_rows>0){
    while ($row = $res->fetch_assoc()){
        $pagepos = $row['pagepos'];
    }
}
echo "<h1> Welcome Back You will be moved the page where you left</h1>";

switch ($pagepos) {
    case 1:
        # code...
        header('location:tests/trailvid1.php?id='.$id);
        break;
    case 2:
        header('location:tests/trailvid1.php?id='.$id);
        break;
    case 3:
        header('location:tests/trailvid2.php?id='.$id);
        break;
    case 4:
        header('location:tests/trailvid2.php?id='.$id);
        break;
    case 5:
        header('location:tests/vid1.php?id='.$id);
        break; 
    case 6:
        header('location:tests/vid1.php?id='.$id);
        break;
    case 7:
        header('location:tests/vid2.php?id='.$id);
        break;
    case 8:
        header('location:tests/vid2.php?id='.$id);
        break;
    case 9:
        header('location:tests/vid3.php?id='.$id);
        break;
    case 10:
        header('location:tests/vid3.php?id='.$id);
        break;
    case 11:
        header('location:tests/vid4.php?id='.$id);
        break;
    case 12:
        header('location:tests/vid4.php?id='.$id);
        break;
    case 13:
        header('location:tests/vid5.php?id='.$id);
        break;
    case 14:
        header('location:tests/vid5.php?id='.$id);
        break;
    case 15:
        header('location:tests/vid6.php?id='.$id);
        break;
    case 16:
        header('location:tests/vid6.php?id='.$id);
        break;
    default:
        # code...
        header('location:welcome_page.php?id='.$id);
        break;
}
if ($pagepos==17){
    //check if user has given atleast 2 correct answers


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
            header('location:errors/testfail.php?id='.$id);

        }
        else{



            header('location:end.php?id='.$id);

        }   
}