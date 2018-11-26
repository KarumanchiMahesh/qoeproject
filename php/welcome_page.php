<?php
session_start();
?>
<!doctype html>
<html>
<head>
  <title>
    welcome_page
  </title>
  <meta charset="utf-8" content="width=device-width">
  <link href="styles/main.css" rel="stylesheet">
</head>
<?php
include('dbinfo.inc.php');
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if ($conn){
  //echo 'success';
}
$id = $_GET['id'];
//check if worker already exists -> redirect to reconnection.php

//check if worker already completed the test

$sql = 'select * from results where subject_id='.$id;

$res = $conn->query($sql);
if ($res->num_rows>0){

  header('location:errors/testalreadycompleted.php?id='.$id);
}
else{
  //do nothing 
  //user not completed the test
}
 //check if worker trying to reconnect
$sql = 'select * from users_count where subject_id='.$id;

$res = $conn->query($sql);
if ($res->num_rows>0){
 
  $sql2 = 'select * from tasks_completed where subject_id='.$id;

  $res2 = $conn->query($sql);
  if ($res2->num_rows>0){
    while($row = $res2->fetch_assoc()){
      $pagepos = $row['pagepos'];
    }
    echo $pagepos;
    if ($pagepos==0){
      echo "reloading";
      echo $pagepos;
      header('location:reconnect.php?id='.$id);
      //do nothing 
      //worker is reloading the same page
    }
    else {
     //
       header('location:reconnect.php?id='.$id);
    }
  }
  else{
    //do something 
    //may be data of the user not inserted into tasks_completed table
  }
}
else{
  //new worker entering into the test
  $sql3 = "insert into users_count (subject_id) values ('$id')";
  $res3 = $conn->query($sql3);
  if (!$res3){
    //echo "failed to insert new user data";
  }
  $sql4 = "select * from users_count where subject_id=".$id;
  $res4 = $conn->query($sql4);
  if ($res4->num_rows>0){
    //echo 'data found';
    while ($row=$res4->fetch_assoc()){
      $token_no = $row['s.no'];
      //echo $token_no;
    }

  }
  else{
    //echo 'no data found';
  }
  if ($token_no==''){
    //echo 'no token issued';
  }
  
  $tasks_completed = 0;
  $pagepos = 1;
  echo $token_no.'<br>'.$id.'<br>'.$tasks_completed;
  $sql5 = "insert into tasks_completed (subject_id,token_no,numcompleted,viewcompleted,pagepos) values ('$id','$token_no',0,'$pagepos')";
  $res5 = $conn->query($sql5);
  if (!$res5){
    //echo "failed inserting data into tasks_completed";
  }

  $sql6 = "insert into temporary_data (subject_no,subject_id) values ('$token_no','$id')";
  $res6 = $conn->query($sql6);
  if (!$res6){
    echo "failed inserting data into tasks_completed";
  }
  else{
    echo "success";
  }
}

// loading video sequence


?>
<body>
  <h1 class="heading">Welcome To Video Quality Assessment Test</h1>
  <p class="content">Matter</p>
   <div style="text-align:center;">
    <input type="button" onclick="window.location.href='<?php echo "tests/trailvid1.php?id=".$id;?>'" value="Start">
  </div>

</body>

</html>