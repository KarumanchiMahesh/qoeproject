<?php 
session_start();
if (isset($_SESSION['views5'])){
    $_SESSION['views5'] += 1;

}
else{
    $_SESSION['views5'] = 1;
}
?>
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
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Test Video </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <style>
        body {background-image:url('../img/low_contrast_linen.png');}
    </style>
    <link rel="icon" type="image/ico" href="../img/icon.ico"> 
</head>
<body>
    <?php
    include("../dbinfo.inc.php");
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $id = $_GET['id'];
    $res = $conn->query('select token_no from tasks_completed where subject_id='.$id);
    if ($res->num_rows>0){
        while ($row = $res->fetch_assoc()){
            $token_no = $row['token_no'];
        }
    }
    if ($token_no%14==0){
        $vid_id=14;
    }
    else{
        $vid_id=($token_no)%14;
    }
    $vid_id=$vid_id+56;
    //echo $token_no;
     
    $res = $conn->query('select video_name from video_storage where id='.$vid_id);
    if ($res->num_rows>0){
        while ($row = $res->fetch_assoc()){
            $vid = $row['video_name'];
        }
    }
    $res = $conn->query("update temporary_data set vid5="."'".$vid."'"." where subject_id=".$id);
    $res = $conn->query("update tasks_completed set pagepos="."'"."vid5"."'"." where subject_id=".$id);
    
    ?>
    <div class="container">
        <br>
            <div class="col-md-4">
                <font color="white" class="h1">Test Video </font>
            </div>

            <div class="btn-group btn-group-lg col-md-7">
                <button type="button" id ="play" class="btn btn-primary" style="width:150px;height:50px" onclick="vidplay();">Play Again</button>
            </div> 
            <div class="col-md-1">
                <button  type="button" id ="Instruction" class="btn btn-warning" style="width:100px;height:30px;" onClick="window.open('../instruction/instruction.php#videotest')">Instructions</button>		
            </div>
        </div>
        <br/>
        <br/>

        <div class="text-center">
        <video width="1280" height="720" id="Video1" autoplay><source src="<?php echo '../vids/'.$vid;?>" type="video/mp4">Your browser does not support the video playback.</video>
        </div>
    <script src="../js/jquery.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
    <script type="text/javascript">
            function vidplay() {
                $('#Video1').css("visibility", "visible");
                //$('#play').css("visibility","hidden");
                $('#Video1').get(0).play();            
            }
            $(window).load(function() {
                $("#Video1").bind('ended', function() {
                    window.location.href = "rating5.php?id=<?php echo $id;?>";
                });
            });
            
            //Disable rightclick menu for video
            $(document).ready(function() {
                $('#Video1').bind('contextmenu', function() {
                    return false;
                });
            });
            //Pause video if window is hidden
            $(window).blur(function() {
                $('#Video1').get(0).pause();
                $('#Video1').css("visibility", "hidden");
                $('#play').css("visibility","visible");
                $('#play').css("text","play again");
            });
    </script>
</body>
