<?php
ob_start();

// No Worker-id
if (empty($_GET['id'])) {
    while (ob_get_status()) {
        ob_end_clean();
    }
    header("Location: errors/noid.php");
    exit();
}

include('dbinfo.inc.php');
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$id = $_GET['id'];
//check if worker lost his connection
$sql = "select * from tasks_completed where subject_id=".$id;

$res = $conn->query($sql);
if ($res->num_rows>0){
    while($row=$res->fetch_assoc()){
        $pagepos = $row['pagepos'];
    }
    if ($pagepos=='index.php'){
        //worker is on reloading the same page 
        // do nothing
    }
    else{
        header('location:reconnect.php?id='.$id);
    }

}
else
{
//new entry
//update tasks_completed table 

$sql = "insert into tasks_completed (subject_id) values ('$id')";

$res = $conn->query($sql);
if ($res){
    echo "success";
}
$sql = "select * from tasks_completed where subject_id=".$id;
$res = $conn->query($sql);
if ($res->num_rows>0){
    while ($row = $res->fetch_assoc()){
        $token_no = $row['token_no'];
    }
}
else{
    echo 'no toke issued';
}
$sql = "insert into temporary_data (subject_id,subject_no) values ('$id','$token_no')";
$res = $conn->query($sql);
if ($res){
    echo "success";
}

}

// Check if worker already exist
?>

<!DOCTYPE html> 
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->


<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Test instructions</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <noscript>
    <meta http-equiv="refresh" content="0; url=http://qualitest.servplads.in/errors/javascript.php" />
    </noscript>
    <link rel="icon" type="image/ico" href="img/icon.ico"> 
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' /> <!-- Disable zoom -->
    <meta name="viewport" content="width=device-width" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="span4 logo text-center">
                <h1>Task Instructions</h1>
            </div>
        </div>
        <div class="row">
            <div class="span12">
                <div class="hero-unit" id="intro">
                    <br/>
                    <p class='lead'>In this task, you will be shown pairs of videos (one after the other) without audio. Some videos will be of different quality and some will include stopping. After each pair of videos you will be asked to select the video you preferred to view. Please answer the questions below before starting the task. All information is anonymous.
                        Detailed instructions can be found <a href="instruction/instruction.php" target="_blank">here</a>.</p>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        Toggle more information <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Video streaming is common all over the world and used in applications such as video sharing, video on demand and broadcast. <br>
                                Some users of such applications might have limited or varying bandwidth (maybe due to a slow internet connection or unreliable <br> 
                                wifi). To counter this problem, one can either reduce the quality of the videos or use buffering (which will be perceived as <br>
                                stopping when viewing the video). Many providers of video streaming services use a technology known as adaptive bitrate <br>
                                streaming. This technology is used to adapt the quality of the streaming videos to the available bandwidth of the user, such <br>
                                that buffering (stopping) event are usually avoided. This is a great solution in many cases, but also leads to some open <br>
                                unanswered questions, such as: "When is buffering preferable over low video quality?" and "When does variation of video quality <br>
                                annoy the user?". <br>
                                One goal of this research is to shed some light on these questions. Thank you for your interest!</a></li>
                    </ul>

                </div>

                <div class="text-center" id="screentestDone" style="display:none">
                    <h1>Thank You!</h1>
                    <p>Answer the questions below and you're ready to start the video test.</p>
                </div>

                <div class="text-center" id="screentest">
                    <h1>Screen Test</h1>

                    <form class="form-horizontal" action="#" method="post" id="frm-screenTestForm">

                        <blockquote>
                            <p>Please select highest and smallest <strong>visible number </strong> on the white picture below.</p> 
                            <small><span class="label label-danger">Note:</span> There can be <cite title="zero or more of them!">no numbers in the picture!</cite> If you don't see any numbers just answer with "none".</small>
                        </blockquote>

                        <div id="smallestVisible">

                            <label>Smallest visible number:</label>

                            <div class="btn-group btn-group-sm btn-group-justified" data-toggle="buttons">
                                <label class="btn btn-default" for="frmscreenTestForm-smallestNumber-0"> 
                                    <input type="radio" name="smallestNumber" id="frmscreenTestForm-smallestNumber-0" required="required" value="9" />  9 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-smallestNumber-1"> 
                                    <input type="radio" name="smallestNumber" id="frmscreenTestForm-smallestNumber-1" required="required" value="8" />  8 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-smallestNumber-2"> 
                                    <input type="radio" name="smallestNumber" id="frmscreenTestForm-smallestNumber-2" required="required" value="7" />  7 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-smallestNumber-3"> 
                                    <input type="radio" name="smallestNumber" id="frmscreenTestForm-smallestNumber-3" required="required" value="6" />  6 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-smallestNumber-4"> 
                                    <input type="radio" name="smallestNumber" id="frmscreenTestForm-smallestNumber-4" required="required" value="5" />  5 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-smallestNumber-5"> 
                                    <input type="radio" name="smallestNumber" id="frmscreenTestForm-smallestNumber-5" required="required" value="4" />  4 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-smallestNumber-6"> 
                                    <input type="radio" name="smallestNumber" id="frmscreenTestForm-smallestNumber-6" required="required" value="3" />  3 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-smallestNumber-7"> 
                                    <input type="radio" name="smallestNumber" id="frmscreenTestForm-smallestNumber-7" required="required" value="2" />  2 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-smallestNumber-8"> 
                                    <input type="radio" name="smallestNumber" id="frmscreenTestForm-smallestNumber-8" required="required" value="1" />  1 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-smallestNumber-9"> 
                                    <input type="radio" name="smallestNumber" id="frmscreenTestForm-smallestNumber-9" required="required" value="0" />  0 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-smallestNumber-10"> 
                                    <input type="radio" name="smallestNumber" id="frmscreenTestForm-smallestNumber-10" required="required" value="none" />  none 
                                </label>
                            </div>
                        </div>

                        <div id="highestVisible">

                            <label>Highest visible number:</label>

                            <div class="btn-group btn-group-sm btn-group-justified" data-toggle="buttons">
                                <label class="btn btn-default" for="frmscreenTestForm-highestNumber-0"> 
                                    <input type="radio" name="highestNumber" id="frmscreenTestForm-highestNumber-0" required="required" value="0" />  0 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-highestNumber-1"> 
                                    <input type="radio" name="highestNumber" id="frmscreenTestForm-highestNumber-1" required="required" value="1" />  1 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-highestNumber-2"> 
                                    <input type="radio" name="highestNumber" id="frmscreenTestForm-highestNumber-2" required="required" value="2" />  2 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-highestNumber-3"> 
                                    <input type="radio" name="highestNumber" id="frmscreenTestForm-highestNumber-3" required="required" value="3" />  3 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-highestNumber-4"> 
                                    <input type="radio" name="highestNumber" id="frmscreenTestForm-highestNumber-4" required="required" value="4" />  4 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-highestNumber-5"> 
                                    <input type="radio" name="highestNumber" id="frmscreenTestForm-highestNumber-5" required="required" value="5" />  5 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-highestNumber-6"> 
                                    <input type="radio" name="highestNumber" id="frmscreenTestForm-highestNumber-6" required="required" value="6" />  6 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-highestNumber-7"> 
                                    <input type="radio" name="highestNumber" id="frmscreenTestForm-highestNumber-7" required="required" value="7" />  7 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-highestNumber-8"> 
                                    <input type="radio" name="highestNumber" id="frmscreenTestForm-highestNumber-8" required="required" value="8" />  8 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-highestNumber-9"> 
                                    <input type="radio" name="highestNumber" id="frmscreenTestForm-highestNumber-9" required="required" value="9" />  9 
                                </label>
                                <label class="btn btn-default" for="frmscreenTestForm-highestNumber-10"> 
                                    <input type="radio" name="highestNumber" id="frmscreenTestForm-highestNumber-10" required="required" value="none" />  none 
                                </label>
                            </div>
                        </div>

                        <div class="contrast-wp" id="numbers" align="left">
                            <div class="con11">1</div>
                            <div class="con12">2</div>
                            <div class="con13">3</div>
                            <div class="con14">4</div>
                            <div class="con15">5</div>
                            <div class="con16">6</div>
                            <div class="con17">7</div>
                            <div class="con18">8</div>
                        </div>

                        <blockquote>
                            <p>Please click and select <strong>all visible stars</strong> on the following picture.</p> 
                            <small><span class="label label-danger">Note:</span> There can be <cite title="zero or more of them!">zero or more of them!</cite></small>
                        </blockquote>

                        <!-- Contrast wrapper form with black stars -->
                        <div class="contrast-wp contrastBlack-wp" id="contrastBlack-wp">
                            <input type="checkbox" name="blackStars[]" id="frmscreenTestForm-blackStars-0" value="1" />
                            <label for="frmscreenTestForm-blackStars-0">
                                <span class="con21 stars clickable">
                                    <div aria-hidden="true" data-icon="&#xe000;"></div>
                                </span>
                            </label>
                            <input type="checkbox" name="blackStars[]" id="frmscreenTestForm-blackStars-1" value="2" />
                            <label for="frmscreenTestForm-blackStars-1">
                                <span class="con22 stars clickable">
                                    <div aria-hidden="true" data-icon="&#xe000;"></div>
                                </span>
                            </label>
                            <input type="checkbox" name="blackStars[]" id="frmscreenTestForm-blackStars-2" value="3" />
                            <label for="frmscreenTestForm-blackStars-2">
                                <span class="con23 stars clickable">
                                    <div aria-hidden="true" data-icon="&#xe000;"></div>
                                </span>
                            </label>
                            <input type="checkbox" name="blackStars[]" id="frmscreenTestForm-blackStars-3" value="4" />
                            <label for="frmscreenTestForm-blackStars-3">
                                <span class="con24 stars clickable">
                                    <div aria-hidden="true" data-icon="&#xe000;"></div>
                                </span>
                            </label>
                            <input type="checkbox" name="blackStars[]" id="frmscreenTestForm-blackStars-4" value="5" />
                            <label for="frmscreenTestForm-blackStars-4">
                                <span class="con25 stars clickable">
                                    <div aria-hidden="true" data-icon="&#xe000;"></div>
                                </span>
                            </label>
                            <input type="checkbox" name="blackStars[]" id="frmscreenTestForm-blackStars-5" value="6" />
                            <label for="frmscreenTestForm-blackStars-5">
                                <span class="con26 stars clickable">
                                    <div aria-hidden="true" data-icon="&#xe000;"></div>
                                </span>
                            </label>
                            <input type="checkbox" name="blackStars[]" id="frmscreenTestForm-blackStars-6" value="7" />
                            <label for="frmscreenTestForm-blackStars-6">
                                <span class="con27 stars clickable">
                                    <div aria-hidden="true" data-icon="&#xe000;"></div>
                                </span>
                            </label>
                            <input type="checkbox" name="blackStars[]" id="frmscreenTestForm-blackStars-7" value="8" />
                            <label for="frmscreenTestForm-blackStars-7">
                                <span class="con28 fstars clickable">
                                    <div aria-hidden="true" data-icon="&#xe000;"></div>
                                </span>
                            </label>
                        </div>

                        <!-- Hidden inputs for application layer monitoring -->

                        <div class="hidden"><input type="hidden" name="screen" id="frmscreenTestForm-screen" value="" /></div>
                        <div class="hidden"><input type="hidden" name="focusTime" id="frmscreenTestForm-focusTime" value="" /></div>
                        <div class="hidden"><input type="hidden" name="clickNo" id="frmscreenTestForm-clickNo" value="" /></div>
                        <div class="hidden"><input type="hidden" name="clickCounter" id="frmscreenTestForm-clickCounter" value="" /></div>
                        <div class="hidden"><input type="hidden" name="browser" id="frmscreenTestForm-browser" value="" /></div>


                        <input class="btn btn-lg btn-primary" type="submit" name="submit_" id="frmscreenTestForm-submit" value="Submit Screen Results" />

                        <p class="pull-right"><small>&copy; FTW 2013</small></p>

                    </form> 

                </div>

                <br>

                <form action="" method="post">


                    <div class="text-center" style="border:2px solid;border-radius:25px;">
                        <h1>Questionnaire</h1>

                        <div class="text-center">


                            <table align="center" cellspacing="100" cellpadding="40">
                                <tr>
                                    <td><font size="4">
                                        <b><font size="5">Age</font></b></br>

                                        <input type="radio" name="Age" value="0-20"> 0-20
                                        <br>
                                        <input type="radio" name="Age" value="21-30"> 21-30
                                        <br>
                                        <input type="radio" name="Age" value="31-40"> 31-40
                                        <br>
                                        <input type="radio" name="Age" value="41-60"> 40-60
                                        <br>
                                        <input type="radio" name="Age" value="61 and above"> 61 and above
                                        </font>
                                    </td>

                                    <td><font size="4">
                                        <b><font size="5">Current environment</font></b></br>
                                        <input type="radio" name="Environment" value="Home"> Home
                                        <br>
                                        <input type="radio" name="Environment" value="Office"> Office
                                        <br>
                                        <input type="radio" name="Environment" value="Cafe"> Lunch Room/Cafeteria/Diner
                                        <br>
                                        <input type="radio" name="Environment" value="Other"> Other
                                        </font>
                                    </td>
                                </tr>

                                <tr>
                                    <td><font size="4">
                                        <b><font size="5">Gender</font></b></br>
                                        <input type="radio" name="Gender" value="Male"> Male
                                        <br>
                                        <input type="radio" name="Gender" value="Female"> Female
                                        </font>
                                    </td>

                                    <td><font size="4">
                                        <b><font size="5">How many hours per day <br>did you typically watch videos  <br>(including TV) last week?</font></b></br>
                                        <input type="radio" name="Hours" value="0"> None
                                        <br>
                                        <input type="radio" name="Hours" value="Less than 1 hour"> Less than 1 hour
                                        <br>
                                        <input type="radio" name="Hours" value="1-2 hours"> 1-2 hours
                                        <br>
                                        <input type="radio" name="Hours" value="2-3 hours"> 2-3 hours
                                        <br>
                                        <input type="radio" name="Hours" value="More than 3 hours"> More than 3 hours
                                        </font>
                                    </td>
                                </tr>
                            </table>

                            <p>
                                <input name="submit" type="submit" class="btn btn-primary btn-large"  id="start" value="Start Test &raquo;" style="width:150px;visibility:visible;">
                            </p>
                          
                      

                            </div>
                        
                        </div>

                </form>


               
            </div>
        </div>
        
    </div> <!-- /container -->


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
    <script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="js/screentest.js"></script>
    <script>
        var time = 0;
        var dstart = new Date();
        var timestart = dstart.getTime();
        $(window).load(function() {
            if (($(window).height() < 810) || ($(window).width() < 1260)) {
                window.location = "errors/resolution.php?id=<?php echo $worker_id ?>";
            }
            else {
                $("#Video1").get(0).playbackRate = 16;
                $("#Video2").get(0).playbackRate = 16;
                loop(0);
            }

        });

        $('.dropdown-toggle').dropdown();

        // Screentest submit
        $("#frmscreenTestForm-submit").click(function(e) {
            e.preventDefault();
            end = new Date().getTime();
            finalTime = end - start;
            clickCounter_string = JSON.stringify(clickCounter);
            stars = [0, 0, 0, 0, 0, 0, 0, 0, 0];
            if ($('#smallestVisible input[type=radio]:checked').length < 1) {
                $('#smallestVisible').addClass('checkbox-error');
                alert('Please select smallest visible number');
            }
            else if ($('#highestVisible input[type=radio]:checked').length < 1) {
                $('#highestVisible').addClass('checkbox-error');
                alert('Please select highest visible number');
            }
            else {

                var score = screentestScore($('#smallestVisible input[type=radio]:checked').val(), $('#highestVisible input[type=radio]:checked').val(), stars, finalTime, clickNo);
                var data = 'id=' + encodeURIComponent("<?php echo $worker_id ?>") +
                        '&Lowest=' + encodeURIComponent($('#smallestVisible input[type=radio]:checked').val()) +
                        '&Highest=' + encodeURIComponent($('#highestVisible input[type=radio]:checked').val()) +
                        '&Time=' + encodeURIComponent(finalTime) +
                        '&ClickNum=' + encodeURIComponent(clickNo) +
                        '&Score=' + encodeURIComponent(score);
                $.each($("input[name='blackStars[]']:checked"), function() {
                    data += "&Star" + $(this).val() + "=" + encodeURIComponent("1");
                    stars[$(this).val()] = 1;
                });
               
                if (score > 5) {
                    window.location.href = "errors/screentestfail.php";
                }
                else{
                    $('#screentest').toggle(1,"swing",screentestDone());
                }

            }

        });

        // Start button
        $("#start").click(function() {
            

            if ($('#screentestDone').css('display') == 'none') {
                alert("Please complete the screen test.");
                return false;
            }
            else if (!$("input[name='Age']:checked").val() || !$("input[name='Environment']:checked").val() || !$("input[name='Gender']:checked").val() || !$("input[name='Hours']:checked").val())
            {
                alert("Please answer all questions.");
                return false;
            }
            else if ($(this).hasClass('disabled')) {
                return false;
            }
            else {
                //do nothing
            

            }
        });

        function screentestScore(Lowest, Highest, Stars, Time, ClickNum) {
            var score = 0;
            var starSum = 0;
            // No stars selected
            for (k = 1; k < 9; k++) {
                starSum += Stars[k];
            }
            if (starSum === 0)
                score += 1;
            // Selected stars are not consecutive
            for (k = 1; k < 7; k++) {
                if (Stars[k] < Stars[k + 1]) {
                    score += 2;
                    break;
                }
            }

            // Invisble star selected
            score += 3 * Stars[8];
            // Inconsistent none-answer
            if ((Lowest == "none" && Highest != "none") || (Highest == "none" && Lowest != "none"))
                score += 3;
            // Lowest outside interval    
            if (Lowest != "none")
                if ((Lowest < 0) || (Lowest > 7))
                    score += 3;
            // Highest outside interval
            if (Highest != "none")
                if ((Highest < 0) || (Highest > 7))
                    score += 3;
            // Lowest and Highest inconsistent
            if (Highest < Lowest)
                score += 1;
            // Low time on page
            if (Time < 6000)
                score += 1;
            // Clicks on background            
            if (ClickNum > 1) {
                score += 1;
                if (ClickNum > 3)
                    score += 3;
            }
            return score;
        }

        function screentestDone() {
            $('#screentestDone').toggle();
        }


      

    </script> 
   

 <?php
    echo "<p>hello</p>";
    echo $id;
    $sql = "select * from tasks_completed where subject_id=".$id;
    $res = $conn->query($sql);
    if ($res->num_rows>0){
        while ($row = $res->fetch_assoc()){
            $token_no = $row['token_no'];
            

        }
        echo "token issues";
    }
    else{
    echo 'no toke issued';
    }
    if (isset($_POST['submit'])){
        $gender = $_POST['Gender'];
        $age = $_POST['Age'];
        $environment = $_POST['Environment'];
        $hours = $_POST['Hours'];
        
        
        if ($gender!=''&&$age!=''&&$environment!=''&&$hours!=''){
            
            $sql =  "UPDATE `temporary_data` SET `age`="."'".$age."'".",`gender`="."'".$gender."'".",`hours`="."'".$hours."'".",`environment`="."'".$environment."'"." where subject_id="."'".$id."'";
            $res = $conn->query($sql);
             if ($res){
                //update nextpageposition
                $pagepos = 'trailvid1'; 
                $sql = "update `tasks_completed` set pagepos="."'".$pagepos."'"." where subject_id="."'".$id."'";
                $res = $conn->query($sql);
                if ($res){
                header('location:tests/trailvid1.php?id='.$id);
                }
              }
            else{
                header('location:tests/trailvid2.php?id='.$id);
            }
        }
        
    }
?>
</body>
</html>