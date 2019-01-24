<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Trail Video 2</title>
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
    $sql2 = 'select video_name from video_storage where id=2';
    $res2 = $conn->query($sql2);
    if ($res2->num_rows>0){
        while ($row = $res2->fetch_assoc()){
            $vid = $row['video_name'];
        }
    }
    $res = $conn->query("update temporary_data set trailvid2="."'".$vid."'"." where subject_id=".$id);
    $res = $conn->query("update tasks_completed set pagepos="."'"."trailvid2"."'"." where subject_id=".$id);
    ?>
    <div class="container">
        <br>
            <div class="col-md-4">
                <font color="white" class="h1">Trail Video 2</font>
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
            <?php echo "<div><p>video played=test2</p></div>";?>    
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
                    window.location.href = "form2.php?id=<?php echo $id ?>";
                });
            });
            $('#next').on('click', function() {
                if ($(this).attr('visibility') === 'hidden') {
                    // do nothing
                }
                else {
                            window.location.href = "form2.php?id=<?php echo $id ?>";
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
                $('#play').css('visibility',"visible");    
                $('#play').text("Play");

            });
    </script>
</body>
