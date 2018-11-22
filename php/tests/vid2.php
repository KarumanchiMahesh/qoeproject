<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Test Video 2</title>
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

    $sql = 'select token_no from tasks_completed where subject_id='.$id;

    $res = $conn->query($sql);

    if ($res->num_rows>0){
        while ($row = $res->fetch_assoc()){
            $token_no = $row['token_no'];
        }

    }
    else{
        echo "no token issued";
    }

    $vid_id = ($token_no%14)+14;
    echo $token_no;

    $sql2 = 'select video_name from video_storage where id=1';//id=$task_id
    $res2 = $conn->query($sql2);
    if ($res2->num_rows>0){
        while ($row = $res2->fetch_assoc()){
            $vid = $row['video_name'];
        }
    }
    echo $vid;
    $vid2 = $vid;

    $sql3 = "update temporary_data set vid2="."'".$vid2."'"." where subject_id=".$id;

    $res3 = $conn->query($sql3);

    if ($res3){
        echo "success";
    }
    $pagepos = 8;
    $sql4 = "update tasks_completed set pagepos="."'".$pagepos."'"." where subject_id=".$id;
    $res4 = $conn->query($sql4);
    if ($res4){
        echo "success";
    }


  //  $tmp = $dbname . ".subjects";
   // $next = $conn->query("SELECT * FROM $tmp WHERE Name='$id'")->fetch_object()->Next;

    //$sql = "SELECT test_id$next FROM $tmp WHERE Name='$id'";

    //$test_id = $conn->query($sql)->fetch_row();

    //$sql2 = "SELECT * FROM " . $dbname . ".results WHERE Test_id='$test_id[0]'";

    //$vid = $conn->query($sql2)->fetch_object()->Vid1;

    //mysqli_close($conn);



    ?>

    <div class="container">
        <br>
            <div class="col-md-4">
                <font color="white" class="h1">Test Video 2</font>
            </div>

            <div class="btn-group btn-group-lg col-md-7">
                <button type="button" id ="play" class="btn btn-primary" style="width:150px;height:50px" onclick="vidplay();">Play</button>
                <button type="button" class="btn btn-primary" id="next" style="width:150px;height:50px;visibility:hidden">Continue</button>
            </div> 
            <div class="col-md-1">
                <button  type="button" id ="Instruction" class="btn btn-warning" style="width:100px;height:30px;" onClick="window.open('../instruction/instruction.php#videotest')">Instructions</button>		
            </div>
        </div>
        <br/>
        <br/>

        <div class="text-center">
        <script>
            var html = '<video width="1280" height="720" id="Video1" autoplay><source src="../vids/test1.mp4" type="video/mp4">Your browser does not support the video playback.</video>';
            document.write(html);
        </script>
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
                    $('#next').css("visibility", "visible");
                    $('#play').text("Play again");
                    $('#Video1').css("visibility", "hidden");
                });
            });

            $('#next').on('click', function() {
                if ($(this).attr('visibility') === 'hidden') {
                    // do nothing
                }
                else {
        
                            window.location.href = "form4.php?id=<?php echo $id ?>";
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
