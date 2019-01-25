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
                    <h2 id="videotest">Introduction</h2>
                </div>
                <div></br></div>
                <div  style="border:1px solid;border-radius:10px;">
                    </br>
                    <ul>
                    <li><P class='lead'>Hello users!the main purpose of this survey is to collect valuable <b><font size="4">User(Subjective) Quality Rating using Crowdsourcing Methods.</font></b></P></li>
                    
                    <li><P class='lead' >There will be two sessions in this test.<b><font size="4">Trail,Main</font></b></p></li>
        </ul>
                
                    
                    
                    </br>

                </div>
            </div>

            <div class="row">

                <div class="btn-group" align="center">
                    <h2 id="endpage">Trail Session</h2>
                </div>
                <div></br></div>
                <div  style="border:1px solid;border-radius:10px;">
                    </br>
                    
                         <P class='lead' >In this you will be given two videos of different qualities to watch.</P>
                         <P class='lead' >For each video rate the video from <b><font size="4">Excellent</font></b> to <b><font size="4">Bad</font></b> based on it's quality. The videos may be freezing or of low visual quality as shown in figure below.</P>
                         <div align="center">
                            <img src="../instruction/Images/video_test.jpg" style="border:1px; black" alt="icon 1">
                        </div>
                    

                </div>
            </div>
            <div class="row">

                <div class="btn-group" align="center">
                    <h2 id="endpage">Main Session</h2>
                </div>
                <div></br></div>
                <div  style="border:1px solid;border-radius:10px;">
                    </br>
                    <ul>
                        <li> <P class='lead' >You will be given 6 random videos to watch.</P></li>
                        <li> <P class='lead' >Rate the Videos based on it's quality.</P></li>
                        <li> <P class='lead' >For few videos we will ask some questions based on what you watched in video. Be careful while answering the questions. If you haven't answered correctly you will be failed in the test.</P></li>
                    </ul>

                </div>
            </div>
            <div class="row">

                <div class="btn-group" align="center">
                    <h2 id="endpage">End Page</h2>
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
<button  class= "block" onclick="window.location.href='<?php echo "trailvid1.php?id=".$id;?>'">I'm ready to start the test</button>


</body>
</html>





