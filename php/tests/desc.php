<?php
include('../dbinfo.inc.php');
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
$id = $_GET['id'];

{
    //load the first location
    $res = $conn->query("select token_no from tasks_completed where subject_id=".$id);
    if ($res->num_rows>0){
        while($row=$res->fetch_assoc()){
            $token_no = $row['token_no'];
        }
    }
    $res = $conn->query("select * from video_randomiser where id=".$token_no);
    if ($res->num_rows>0){
        while($row=$res->fetch_assoc()){
            $loc = $row['loc1'];
        }
    }

    $loc = $loc.'.php?id='.$id;
    
    //update user status
    $res = $conn->query("insert into user_status (subject_id,count) values ('$id',1)");
    
    
}
?>
<!DOCTYPE html>
<?php include("../dbinfo.inc.php"); ?>
<html lang="fr">

    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=8, IE=9" />
        <link href="../css/bootstrap.css" rel="stylesheet">
        <meta charset="UTF-8" />
        <meta http-equiv="content-language" content="fr" />
        <title>Instruction page</title>
        <style>
            .block {
                 display: block;
                    width: 100%;
            border: none;
            background-color: #4CAF50;
            color: white;
            padding: 14px 40px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            margin-bottom: 20px;
            }

            .block:hover {
            background-color: #ddd;
            color: black;
            }
        </style>
    </head>
<body>
    <div class="container">

        <div class="row" >
            <div class="span4 logo text-center" style="background-color:#428bca;border-radius:10px;">
                <h1 class="main_title">Instructions</h1>
            </div>
        </div>
        </br>
        
        <div class="row">

            

            <div class="row">

                <div class="btn-group"  align="center">
                    <h2 id="videotest">Video test</h2>
                </div>
                <div></br></div>
                <div  style="border:1px solid;border-radius:10px;">
                    </br>
                    <P class='lead'>In the video tests, 6 random videos will be presented to you. The videos contain different degradations such as <b><font size="4"> Freezing events and Low visual quality</font>as shown in fig 4.</b></P>
                    <ul>
                        <li> <P class='lead' >After watching a video you can rate the video. You should base your rating on your perception of the videos and not on the content of the videos.</P></li>
                        <li> <P class='lead' > In some tests you will also be asked a question about the videos you just watched, e.g. what was the color of the jacket that the girl wore in the video ?. It is necessary to answer most of the questions correctly for the payment.</P></li>
                        
                        <li> <P class='lead' >When the Next button appears, click it to continue the task.</P></li>
                    </ul>
                    <div align="center">
                        <img src="../instruction/Images/video_test.jpg" style="border:1px; black" alt="icon 1">
                    </div>
                    </br>

                </div>
            </div>

            <div class="row">

                <div class="btn-group" align="center">
                    <h2 id="endpage">End page</h2>
                </div>
                <div></br></div>
                <div  style="border:1px solid;border-radius:10px;">
                    </br>
                    <ul>
                        <li> <P class='lead' >You have completed the task! Please copy your unique task code and submit it at the task page at microworkers.com</P></li>
                        <li> <P class='lead' >It is necessary to submit the code for the payment.</P></li>
                        <li> <P class='lead' >If you have any comments to this campaign please submit them in the forum thread for this campaign: <a href="<?php echo $feedbackURL ?>">Forum Thread</a></P></li>
                    </ul>

                </div>
            </div>

            <div>
                <font size="4.5">
                <h6 align="right">© video research team. </h6>

                </font>

            </div>
            
        
            
</div>
<button  class= "block" onclick="window.location.href='<?php echo $loc;?>'">I'm ready to start the test</button>


</body>
</html>





