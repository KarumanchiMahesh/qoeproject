<?php
session_start();
$trailvid1 = $_SESSION['trailvid1'];
echo $trailvid1;?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Evaluation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link rel="icon" type="image/ico" href="../img/icon.ico"> 
        <link rel="stylesheet" href="../css/styles.css" />
    </head>

    <body>

        <div align ="right">
            <br/>	
            <button  type="button" id ="Instruction" class="btn btn-warning" style="margin-right: 100px;width:100px;height:30px;" onClick="window.open('../instruction/instruction.php#videotest')">Instructions</button>
        </div>

<div class="container" >
 <div class="main">
 <h2>Rating</h2>
 <span id="error">
 
            <?php
            include("../dbinfo.inc.php");
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

            $id = $_GET['id'];
            //small anti hacking
            $sql='select * from tasks_completed where id='.$id;
            $res=$conn->query($sql);
            if ($res->num_rows>0){
                while($row=$res->fetch_assoc()){
                     $pagepos=$row['pagepos'];
                }
            }
            if ($pagepos=='end'||$pagepos='end_fail'||$pagepos=='end_success'){
                 header('location:../ends/'.$pagepos.'.php?id='.$id);
            } 

            

            ?>



            
          

        <script src="../js/jquery.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
        <script src="../js/bootstrap.js" type="text/javascript"></script>
        <?php

        if ($_POST['rating']!=''){

        //send the received data to temporary_data

            $rating  = $_POST['rating'];

            $sql = "update temporary_data set trailvid2rating="."'".$rating."'"." where subject_id="."'".$id."'";

            $res = $conn->query($sql);

            if ($res){
                
            
        //update page position 
                $pagepos = 'form2.php' ;
                $sql = "update tasks_completed set pagepos="."'".$pagepos."'"." where subject_id="."'".$id."'";
                $res = $conn->query($sql);
                if ($res){
                
                    header('location:little_instructions.php?id='.$id);
                }
            }
        
            

        }    


            
    
        ?>
    </body>
</html>

