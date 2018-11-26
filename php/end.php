<?php


include("dbinfo.inc.php");
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$id = $_GET['id'];

//send complete information from temporary_data to results
        $sql = "select * from temporary_data where subject_id=".$id;
        $res = $conn->query($sql);
        if ($res->num_rows>0){
            while ($row=$res->fetch_assoc()){
                $pagepos = $row['pagepos'];
            }
        }
        else{
            echo "faield";
        }

        if ($pagepos=='end'){
            //do nothing

        }
        else{
       //     $loc = 'tests/'.$pagepos.'.php?id='.$id;
        //    header('location:'.$loc);
        }
        $sql = "select * from passed_results where subject_id=".$id;
        $res = $conn->query($sql);
        if ($res->num_rows>0){
            
        }
        else{
        $sql = "INSERT INTO `passed_results`(`subject_no`, `subject_id`, `age`, `gender`, `hours`, `environment`, `trailvid1`, `trailvid1rating`, `trailvid2`, `trailvid2rating`, `vid1`, `vid1rating`, `question1`, `ansrec1`, `correct1`, `vid2`, `vid2rating`, `vid3`, `vid3rating`, `question3`, `ansrec3`, `correct3`, `vid4`, `vid4rating`, `vid5`, `vid5rating`, `question5`, `ansrec5`, `correct5`, `vid6`, `vid6rating`, `receivedcorrectans`) 
        SELECT * from temporary_data where subject_id=".$id;
        }
        
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>End of Task</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link rel="icon" type="image/ico" href="../img/icon.ico"> 
    </head>

    <body>
        

        <div align ="right">
            <br/>	
            <button  type="button" id ="Instruction" class="btn btn-info" style="margin-right: 100px;width:100px;height:30px;" onClick="window.open('./instruction/instruction.php#endpage')">Instructions</button>
        </div>
        <div class="container text-center">

            <br/>
            <h1>Thank you for your participation.</h1>
            <br/>

            <h2>Your <u>personal</u> code is:</h2>
            <h3 style="color:red">##<?php echo sha1("stuff$id") ?>##</h3>
            <p>Copy and paste the code at microworkers as verification for you participation.</p>
            <button id="myButton" class="btn btn-lg btn-primary" onclick="copyToClipboard('##<?php echo sha1("stuff$id") ?>##')" >Copy</button>                     

            <br><br><br>

            <div class="span4">
                <h2>Feedback</h2>
                <p>If you got feedback for this task, we would like to hear from you.</p>
                <p>Press the button below to go to the discussion thread for this campaign on the official microworkers forum.</p>

                <br>

                <a href="<?php echo $feedbackURL ?>">
                    <button id="forum" class="btn btn-lg btn-primary">Forum</button>
                </a>

            </div>
        </div> <!-- /container -->

        <script>
                function copyToClipboard(text) {
                    window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
                }
        </script>
    
    </body>

</html>

