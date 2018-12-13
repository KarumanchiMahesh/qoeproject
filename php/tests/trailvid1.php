<?php
session_start();
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

    //small anti hacking
    $sql='select * from tasks_completed where id='.$id;
    $res=$conn->query($sql);
    if ($res->num_rows>0){
        while($row=$res->fetch_assoc()){
            $status=$row['status'];
        }
    }
    if ($status=='end'||$status='end_fail'||$status=='end_success'){
        header('location:../ends/'.$status.'.php?id='.$id);
    } 

    $sql2 = 'select video_name from video_storage where id=1';
    $res2 = $conn->query($sql2);
    if ($res2->num_rows>0){
        while ($row = $res2->fetch_assoc()){
            $vid = $row['video_name'];
        }
    }
    $trailvid1 = $vid;

    $sql3 = "update temporary_data set trailvid1="."'".$trailvid1."'"." where subject_id=".$id;

    $res3 = $conn->query($sql3);

   
    $pagepos = 'trailvid1';
    $sql4 = "update tasks_completed set pagepos="."'".$pagepos."'"." where subject_id=".$id;
    $res4 = $conn->query($sql4);
    

    ?>

    <div class="container">
        <br>
            <div class="col-md-4">
                <font color="white" class="h1">Trail Video 1</font>
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
                //    $('#next').css("visibility", "visible");
                //    $('#play').text("Play again");
                //    $('#Video1').css("visibility", "hidden");
                window.location.href="form1.php?id=<?php echo $id;?>";
                });
            });

            $('#next').on('click', function() {
                if ($(this).attr('visibility') === 'hidden') {
                    // do nothing
                }
                else {
                            



                            
                            //window.location.href="form1.php?id=<?php //echo$id;?>";
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
