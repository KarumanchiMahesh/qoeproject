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
    <title>Trail Video 1</title>
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
    $sql2 = 'select video_name from video_storage where id=86';
    $res2 = $conn->query($sql2);
    if ($res2->num_rows>0){
        while ($row = $res2->fetch_assoc()){
            $vid = $row['video_name'];
        }
    }
    echo $vid;
    $trailvid1 = $vid;
    $sql3 = "update temporary_data set trailvid1="."'".$trailvid1."'"." where subject_id=".$id;
    $res3 = $conn->query($sql3);
    if ($res3){
        echo "success";
    }
    $pagepos = 'trailvid1';
    $sql4 = "update tasks_completed set pagepos="."'".$pagepos."'"." where subject_id=".$id;
    $res4 = $conn->query($sql4);
    if ($res4){
        echo "success";
    }
    ?>
    <div class="container">
        <br>
            <div class="col-md-4">
                <font color="white" class="h1">Trail Video 1</font>
            </div>

            <div class="btn-group btn-group-lg col-md-7">
                <button type="button" id ="play" class="btn btn-primary" style="width:150px;height:50px;visibility:hidden" onclick="vidplay();">Play</button>
                <button type="button" class="btn btn-primary" id="next" style="width:150px;height:50px;visibility:hidden">Continue</button>
            </div> 
            <div class="col-md-1">
                <button  type="button" id ="Instruction" class="btn btn-warning" style="width:100px;height:30px;" onClick="window.open('../instruction/instruction.php#videotest')">Instructions</button>		
            </div>
        </div>
        <br/>
        <br/>

        <div class="text-center">
        <video width="1280" height="720" id="Video1" autoplay><source src="<?php echo '../vids/'.$vid.'.mp4';?>" type="video/mp4">Your browser does not support the video playback.</video>
        </div>


    <script src="../js/jquery.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
    <script type="text/javascript">

        

            function vidplay() {
                $('#Video1').css("visibility", "visible");
                $('#Video1').get(0).play();            
            }

            $(window).load(function() {

                $("#Video1").bind('ended', function() {
                    
                    
                    
                    window.location.href="form1.php?id=<?php echo $id ?>";
                });
            });

            $('#next').on('click', function() {
                if ($(this).attr('visibility') === 'hidden') {
                    // do nothing
                }
                else {
                            



                            
                            window.location.href = "form1.php?id=<?php echo $id ?>";
                        }
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
            });

    </script>

</body>
</html>
