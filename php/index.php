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
if (!$conn){
   # echo "connection not success";
}
else{
    #echo "connection success";
}
$id = $_GET['id'];

//check if worker already completed the test
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
    #echo "successful insertion of data into taskscompleted";
}
$sql = "insert into temporary_data (subject_id) values ('$id')";
$res = $conn->query($sql);
if ($res){
    #echo "successful insertion of data into temporrary data";
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

                        <p class="pull-right"><small>&copy; FTW 2018</small></p>

                    </form> 

                </div>

                <br>

                <form action="" method="post" required>


                    <div class="text-center" style="border:2px solid;border-radius:25px;">
                        <h1>Questionnaire</h1>

                        <div class="text-center">


                            <table align="center" cellspacing="100" cellpadding="40">
                                <tr>
                                    <td><font size="3">
                                        <b><font size="4">Age</font></b></br>

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

                                    <td><font size="3">
                                        <b><font size="4">Current environment</font></b></br>
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
                                    <td><font size="3">
                                        <b><font size="4">Gender</font></b></br>
                                        <input type="radio" name="Gender" value="Male"> Male
                                        <br>
                                        <input type="radio" name="Gender" value="Female"> Female
                                        </font>
                                    </td>

                                    <td><font size="3">
                                        <b><font size="4">How many hours per day <br>did you typically watch videos  <br>(including TV) last week?</font></b></br>
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
                                <tr>
                                    <td><font size="3">
                                        <b><font size="4">Residing Country
                                            <select name="country" required>
                                                <option value="">Choose a country</option>
                                                <option value="AFG">Afghanistan</option>
                                                <option value="ALA">Åland Islands</option>
                                                <option value="ALB">Albania</option>
                                                <option value="DZA">Algeria</option>
                                                <option value="ASM">American Samoa</option>
                                                <option value="AND">Andorra</option>
                                                <option value="AGO">Angola</option>
                                                <option value="AIA">Anguilla</option>
                                                <option value="ATA">Antarctica</option>
                                                <option value="ATG">Antigua and Barbuda</option>
                                                <option value="ARG">Argentina</option>
                                                <option value="ARM">Armenia</option>
                                                <option value="ABW">Aruba</option>
                                                <option value="AUS">Australia</option>
                                                <option value="AUT">Austria</option>
                                                <option value="AZE">Azerbaijan</option>
                                                <option value="BHS">Bahamas</option>
                                                <option value="BHR">Bahrain</option>
                                                <option value="BGD">Bangladesh</option>
                                                <option value="BRB">Barbados</option>
                                                <option value="BLR">Belarus</option>
                                                <option value="BEL">Belgium</option>
                                                <option value="BLZ">Belize</option>
                                                <option value="BEN">Benin</option>
                                                <option value="BMU">Bermuda</option>
                                                <option value="BTN">Bhutan</option>
                                                <option value="BOL">Bolivia, Plurinational State of</option>
                                                <option value="BES">Bonaire, Sint Eustatius and Saba</option>
                                                <option value="BIH">Bosnia and Herzegovina</option>
                                                <option value="BWA">Botswana</option>
                                                <option value="BVT">Bouvet Island</option>
                                                <option value="BRA">Brazil</option>
                                                <option value="IOT">British Indian Ocean Territory</option>
                                                <option value="BRN">Brunei Darussalam</option>
                                                <option value="BGR">Bulgaria</option>
                                                <option value="BFA">Burkina Faso</option>
                                                <option value="BDI">Burundi</option>
                                                <option value="KHM">Cambodia</option>
                                                <option value="CMR">Cameroon</option>
                                                <option value="CAN">Canada</option>
                                                <option value="CPV">Cape Verde</option>
                                                <option value="CYM">Cayman Islands</option>
                                                <option value="CAF">Central African Republic</option>
                                                <option value="TCD">Chad</option>
                                                <option value="CHL">Chile</option>
                                                <option value="CHN">China</option>
                                                <option value="CXR">Christmas Island</option>
                                                <option value="CCK">Cocos (Keeling) Islands</option>
                                                <option value="COL">Colombia</option>
                                                <option value="COM">Comoros</option>
                                                <option value="COG">Congo</option>
                                                <option value="COD">Congo, the Democratic Republic of the</option>
                                                <option value="COK">Cook Islands</option>
                                                <option value="CRI">Costa Rica</option>
                                                <option value="CIV">Côte d'Ivoire</option>
                                                <option value="HRV">Croatia</option>
                                                <option value="CUB">Cuba</option>
                                                <option value="CUW">Curaçao</option>
                                                <option value="CYP">Cyprus</option>
                                                <option value="CZE">Czech Republic</option>
                                                <option value="DNK">Denmark</option>
                                                <option value="DJI">Djibouti</option>
                                                <option value="DMA">Dominica</option>
                                                <option value="DOM">Dominican Republic</option>
                                                <option value="ECU">Ecuador</option>
                                                <option value="EGY">Egypt</option>
                                                <option value="SLV">El Salvador</option>
                                                <option value="GNQ">Equatorial Guinea</option>
                                                <option value="ERI">Eritrea</option>
                                                <option value="EST">Estonia</option>
                                                <option value="ETH">Ethiopia</option>
                                                <option value="FLK">Falkland Islands (Malvinas)</option>
                                                <option value="FRO">Faroe Islands</option>
                                                <option value="FJI">Fiji</option>
                                                <option value="FIN">Finland</option>
                                                <option value="FRA">France</option>
                                                <option value="GUF">French Guiana</option>
                                                <option value="PYF">French Polynesia</option>
                                                <option value="ATF">French Southern Territories</option>
                                                <option value="GAB">Gabon</option>
                                                <option value="GMB">Gambia</option>
                                                <option value="GEO">Georgia</option>
                                                <option value="DEU">Germany</option>
                                                <option value="GHA">Ghana</option>
                                                <option value="GIB">Gibraltar</option>
                                                <option value="GRC">Greece</option>
                                                <option value="GRL">Greenland</option>
                                                <option value="GRD">Grenada</option>
                                                <option value="GLP">Guadeloupe</option>
                                                <option value="GUM">Guam</option>
                                                <option value="GTM">Guatemala</option>
                                                <option value="GGY">Guernsey</option>
                                                <option value="GIN">Guinea</option>
                                                <option value="GNB">Guinea-Bissau</option>
                                                <option value="GUY">Guyana</option>
                                                <option value="HTI">Haiti</option>
                                                <option value="HMD">Heard Island and McDonald Islands</option>
                                                <option value="VAT">Holy See (Vatican City State)</option>
                                                <option value="HND">Honduras</option>
                                                <option value="HKG">Hong Kong</option>
                                                <option value="HUN">Hungary</option>
                                                <option value="ISL">Iceland</option>
                                                <option value="IND">India</option>
                                                <option value="IDN">Indonesia</option>
                                                <option value="IRN">Iran, Islamic Republic of</option>
                                                <option value="IRQ">Iraq</option>
                                                <option value="IRL">Ireland</option>
                                                <option value="IMN">Isle of Man</option>
                                                <option value="ISR">Israel</option>
                                                <option value="ITA">Italy</option>
                                                <option value="JAM">Jamaica</option>
                                                <option value="JPN">Japan</option>
                                                <option value="JEY">Jersey</option>
                                                <option value="JOR">Jordan</option>
                                                <option value="KAZ">Kazakhstan</option>
                                                <option value="KEN">Kenya</option>
                                                <option value="KIR">Kiribati</option>
                                                <option value="PRK">Korea, Democratic People's Republic of</option>
                                                <option value="KOR">Korea, Republic of</option>
                                                <option value="KWT">Kuwait</option>
                                                <option value="KGZ">Kyrgyzstan</option>
                                                <option value="LAO">Lao People's Democratic Republic</option>
                                                <option value="LVA">Latvia</option>
                                                <option value="LBN">Lebanon</option>
                                                <option value="LSO">Lesotho</option>
                                                <option value="LBR">Liberia</option>
                                                <option value="LBY">Libya</option>
                                                <option value="LIE">Liechtenstein</option>
                                                <option value="LTU">Lithuania</option>
                                                <option value="LUX">Luxembourg</option>
                                                <option value="MAC">Macao</option>
                                                <option value="MKD">Macedonia, the former Yugoslav Republic of</option>
                                                <option value="MDG">Madagascar</option>
                                                <option value="MWI">Malawi</option>
                                                <option value="MYS">Malaysia</option>
                                                <option value="MDV">Maldives</option>
                                                <option value="MLI">Mali</option>
                                                <option value="MLT">Malta</option>
                                                <option value="MHL">Marshall Islands</option>
                                                <option value="MTQ">Martinique</option>
                                                <option value="MRT">Mauritania</option>
                                                <option value="MUS">Mauritius</option>
                                                <option value="MYT">Mayotte</option>
                                                <option value="MEX">Mexico</option>
                                                <option value="FSM">Micronesia, Federated States of</option>
                                                <option value="MDA">Moldova, Republic of</option>
                                                <option value="MCO">Monaco</option>
                                                <option value="MNG">Mongolia</option>
                                                <option value="MNE">Montenegro</option>
                                                <option value="MSR">Montserrat</option>
                                                <option value="MAR">Morocco</option>
                                                <option value="MOZ">Mozambique</option>
                                                <option value="MMR">Myanmar</option>
                                                <option value="NAM">Namibia</option>
                                                <option value="NRU">Nauru</option>
                                                <option value="NPL">Nepal</option>
                                                <option value="NLD">Netherlands</option>
                                                <option value="NCL">New Caledonia</option>
                                                <option value="NZL">New Zealand</option>
                                                <option value="NIC">Nicaragua</option>
                                                <option value="NER">Niger</option>
                                                <option value="NGA">Nigeria</option>
                                                <option value="NIU">Niue</option>
                                                <option value="NFK">Norfolk Island</option>
                                                <option value="MNP">Northern Mariana Islands</option>
                                                <option value="NOR">Norway</option>
                                                <option value="OMN">Oman</option>
                                                <option value="PAK">Pakistan</option>
                                                <option value="PLW">Palau</option>
                                                <option value="PSE">Palestinian Territory, Occupied</option>
                                                <option value="PAN">Panama</option>
                                                <option value="PNG">Papua New Guinea</option>
                                                <option value="PRY">Paraguay</option>
                                                <option value="PER">Peru</option>
                                                <option value="PHL">Philippines</option>
                                                <option value="PCN">Pitcairn</option>
                                                <option value="POL">Poland</option>
                                                <option value="PRT">Portugal</option>
                                                <option value="PRI">Puerto Rico</option>
                                                <option value="QAT">Qatar</option>
                                                <option value="REU">Réunion</option>
                                                <option value="ROU">Romania</option>
                                                <option value="RUS">Russian Federation</option>
                                                <option value="RWA">Rwanda</option>
                                                <option value="BLM">Saint Barthélemy</option>
                                                <option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
                                                <option value="KNA">Saint Kitts and Nevis</option>
                                                <option value="LCA">Saint Lucia</option>
                                                <option value="MAF">Saint Martin (French part)</option>
                                                <option value="SPM">Saint Pierre and Miquelon</option>
                                                <option value="VCT">Saint Vincent and the Grenadines</option>
                                                <option value="WSM">Samoa</option>
                                                <option value="SMR">San Marino</option>
                                                <option value="STP">Sao Tome and Principe</option>
                                                <option value="SAU">Saudi Arabia</option>
                                                <option value="SEN">Senegal</option>
                                                <option value="SRB">Serbia</option>
                                                <option value="SYC">Seychelles</option>
                                                <option value="SLE">Sierra Leone</option>
                                                <option value="SGP">Singapore</option>
                                                <option value="SXM">Sint Maarten (Dutch part)</option>
                                                <option value="SVK">Slovakia</option>
                                                <option value="SVN">Slovenia</option>
                                                <option value="SLB">Solomon Islands</option>
                                                <option value="SOM">Somalia</option>
                                                <option value="ZAF">South Africa</option>
                                                <option value="SGS">South Georgia and the South Sandwich Islands</option>
                                                <option value="SSD">South Sudan</option>
                                                <option value="ESP">Spain</option>
                                                <option value="LKA">Sri Lanka</option>
                                                <option value="SDN">Sudan</option>
                                                <option value="SUR">Suriname</option>
                                                <option value="SJM">Svalbard and Jan Mayen</option>
                                                <option value="SWZ">Swaziland</option>
                                                <option value="SWE">Sweden</option>
                                                <option value="CHE">Switzerland</option>
                                                <option value="SYR">Syrian Arab Republic</option>
                                                <option value="TWN">Taiwan, Province of China</option>
                                                <option value="TJK">Tajikistan</option>
                                                <option value="TZA">Tanzania, United Republic of</option>
                                                <option value="THA">Thailand</option>
                                                <option value="TLS">Timor-Leste</option>
                                                <option value="TGO">Togo</option>
                                                <option value="TKL">Tokelau</option>
                                                <option value="TON">Tonga</option>
                                                <option value="TTO">Trinidad and Tobago</option>
                                                <option value="TUN">Tunisia</option>
                                                <option value="TUR">Turkey</option>
                                                <option value="TKM">Turkmenistan</option>
                                                <option value="TCA">Turks and Caicos Islands</option>
                                                <option value="TUV">Tuvalu</option>
                                                <option value="UGA">Uganda</option>
                                                <option value="UKR">Ukraine</option>
                                                <option value="ARE">United Arab Emirates</option>
                                                <option value="GBR">United Kingdom</option>
                                                <option value="USA">United States</option>
                                                <option value="UMI">United States Minor Outlying Islands</option>
                                                <option value="URY">Uruguay</option>
                                                <option value="UZB">Uzbekistan</option>
                                                <option value="VUT">Vanuatu</option>
                                                <option value="VEN">Venezuela, Bolivarian Republic of</option>
                                                <option value="VNM">Viet Nam</option>
                                                <option value="VGB">Virgin Islands, British</option>
                                                <option value="VIR">Virgin Islands, U.S.</option>
                                                <option value="WLF">Wallis and Futuna</option>
                                                <option value="ESH">Western Sahara</option>
                                                <option value="YEM">Yemen</option>
                                                <option value="ZMB">Zambia</option>
                                                <option value="ZWE">Zimbabwe</option>
                                            </select>
                                        </td>
                                        <td><font size="3">
                                            <b> <font size="4">Mother Tongue</font>
                                            <select name="mothertongue" data-placeholder="choose a language" required>
                                                <option value="">Choose a language</option>
                                                <option value="Afrikanns">Afrikanns</option>
                                                <option value="Albanian">Albanian</option>
                                                <option value="Arabic">Arabic</option>
                                                <option value="Armenian">Armenian</option>
                                                <option value="Basque">Basque</option>
                                                <option value="Bengali">Bengali</option>
                                                <option value="Bulgarian">Bulgarian</option>
                                                <option value="Catalan">Catalan</option>
                                                <option value="Cambodian">Cambodian</option>
                                                <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
                                                <option value="Croation">Croation</option>
                                                <option value="Czech">Czech</option>
                                                <option value="Danish">Danish</option>
                                                <option value="Dutch">Dutch</option>
                                                <option value="English">English</option>
                                                <option value="Estonian">Estonian</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finnish">Finnish</option>
                                                <option value="French">French</option>
                                                <option value="Georgian">Georgian</option>
                                                <option value="German">German</option>
                                                <option value="Greek">Greek</option>
                                                <option value="Gujarati">Gujarati</option>
                                                <option value="Hebrew">Hebrew</option>
                                                <option value="Hindi">Hindi</option>
                                                <option value="Hungarian">Hungarian</option>
                                                <option value="Icelandic">Icelandic</option>
                                                <option value="Indonesian">Indonesian</option>
                                                <option value="Irish">Irish</option>
                                                <option value="Italian">Italian</option>
                                                <option value="Japanese">Japanese</option>
                                                <option value="Javanese">Javanese</option>
                                                <option value="Korean">Korean</option>
                                                <option value="Latin">Latin</option>
                                                <option value="Latvian">Latvian</option>
                                                <option value="Lithuanian">Lithuanian</option>
                                                <option value="Macedonian">Macedonian</option>
                                                <option value="Malay">Malay</option>
                                                <option value="Malayalam">Malayalam</option>
                                                <option value="Maltese">Maltese</option>
                                                <option value="Maori">Maori</option>
                                                <option value="Marathi">Marathi</option>
                                                <option value="Mongolian">Mongolian</option>
                                                <option value="Nepali">Nepali</option>
                                                <option value="Norwegian">Norwegian</option>
                                                <option value="Persian">Persian</option>
                                                <option value="Polish">Polish</option>
                                                <option value="Portuguese">Portuguese</option>
                                                <option value="Punjabi">Punjabi</option>
                                                <option value="Quechua">Quechua</option>
                                                <option value="Romanian">Romanian</option>
                                                <option value="Russian">Russian</option>
                                                <option value="Samoan">Samoan</option>
                                                <option value="Serbian">Serbian</option>
                                                <option value="Slovak">Slovak</option>
                                                <option value="Slovenian">Slovenian</option>
                                                <option value="Spanish">Spanish</option>
                                                <option value="Swahili">Swahili</option>
                                                <option value="Swedish ">Swedish </option>
                                                <option value="Tamil">Tamil</option>
                                                <option value="Tatar">Tatar</option>
                                                <option value="Telugu">Telugu</option>
                                                <option value="Thai">Thai</option>
                                                <option value="Tibetan">Tibetan</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Turkish">Turkish</option>
                                                <option value="Ukranian">Ukranian</option>
                                                <option value="Urdu">Urdu</option>
                                                <option value="Uzbek">Uzbek</option>
                                                <option value="Vietnamese">Vietnamese</option>
                                                <option value="Welsh">Welsh</option>
                                                <option value="Xhosa">Xhosa</option>
                                                </select>
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
            stars = [0, 0, 0, 0, 0, 0, 0, 0, 0];//9 stars
            if ($('#smallestVisible input[type=radio]:checked').length < 1) {
                $('#smallestVisible').addClass('checkbox-error');
                alert('Please select smallest visible number');
            }
            else if ($('#highestVisible input[type=radio]:checked').length < 1) {
                $('#highestVisible').addClass('checkbox-error');
                alert('Please select highest visible number');
            }
            else {
                $.each($("input[name='blackStars[]']:checked"), function() {
                    
			stars[$(this).val()] = 1;
			

		});
		

                var score = screentestScore($('#smallestVisible input[type=radio]:checked').val(), $('#highestVisible input[type=radio]:checked').val(), stars, finalTime, clickNo);    
                if (score == 0) {
                    
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
            var score = 5; // to be decided
            var starSum = 0;
            // No stars selected
	    for(k = 0; k < 9; k++) {
                starSum = Stars[k]+starSum;
                
	    }//starSum working
	    if (starSum<4){
			score=0;
	    }
    	if (Lowest>4){
			score=0;
		}
		if (Highest<4){
			score=0;
		}
		if (Time<6000){
			score=0;
		}
		if (Highest=='none'){
			score=0;
		}
		if (Lowest=='none'){
			score=0;
		}
		if (Highest<Lowest){
			score=0;
		}
            
	    
            
            return score;
        }
        function screentestDone() {
            $('#screentestDone').toggle();
        }
      
    </script> 
   

 <?php
    if (isset($_POST['submit'])){
        $gender = $_POST['Gender'];
        $age = $_POST['Age'];
        $environment = $_POST['Environment'];
        $hours = $_POST['Hours'];
        $mothertongue = $_POST['mothertongue'];
        $country = $_POST['country'];
     #   echo $country;
      #  echo $id;
        if ($gender!=''&&$age!=''&&$environment!=''){
            $sql = "update `temporary_data` set `age`="."'".$age."'"." where subject_id=".$id;
       #     echo $sql;
            $res = $conn->query("update temporary_data set age="."'".$age."'".",gender="."'".$gender."'".",hours="."'".$hours."'".",mothertongue="."'".$mothertongue."'".",environment="."'".$environment."'".",country="."'".$country."'"." where subject_id=".$id);
            if ($res){
                //update nextpage position
                $res = $conn->query("update tasks_completed set pagepos="."'"."desctrail"."'"." where subject_id=".$id);
                if ($res){
                    header("location: tests/desctrail.php?id=".$id);
                }
                else{
        #            echo "Not Updated page position";
                }
                }
            else{
         #       echo "not updated";
            }
        }
        
        
    }
?>
</body>
</html>
