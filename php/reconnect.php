<!doctype html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Welcome back</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <link rel="icon" type="image/ico" href="img/icon.ico"> 

</head>
<?php
include('dbinfo.inc.php');
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if ($conn){
  //  echo "success";
}
else{
    echo "Failed connection to database";
}
$id = $_GET['id'];
$sql = "select * from tasks_completed where subject_id=".$id;
$res = $conn->query($sql);
if ($res->num_rows>0){
    while ($row = $res->fetch_array()){
        $page_to_be_loaded = $row['pagepos'];
      //  echo $page_to_be_loaded;
    }

}
else{echo "Failed retrieving data ";}
$nextpage = "tests/".$page_to_be_loaded.".php?id=".$id;
?>
<body>
<div class="container">
        <div class="row">
            <div class="text-center">
                <br><br><br>
                <h1>Welcome back <?php echo $id ?></h1>
            </div>
        </div>
        <div class="row text-center">
            <div>
                <h3>We're loading the test where you left off, please wait...</h3>
            </div>
        </div>

        <br><br><br><br>

        <div class="text-center">

            <p>
                <input name="add" type="submit" class="btn btn-primary btn-large enabled"  id="start" value="Continue Test &raquo;"  onclick="window.location.href='<?php echo $nextpage;?>'" style="width:150px;">
            </p>   

            <br><br>

        </div>


</body>
</html>