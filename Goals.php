 <?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: Login.php");
        
    }
    $userinfo = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUserInfo&userid='.$_SESSION['userid']);
    $userinfo = json_decode($userinfo, true);
    //echo "<div class='userinfo'><span style=\"color:blue;\">" . $_SESSION['username']. "</span>  City: <span style=\"color:blue;\">" . $_SESSION['city']. "</span> Score: <span style=\"color:blue;\">" . $userinfo["score"]. "</span></div>";
    echo '
    <form action="index.php">';
    echo     "<div class='userinfo'><span style=\"color:blue;\">" . $_SESSION['username']. "</span>  City: <span style=\"color:blue;\">" . $_SESSION['city']. "</span> Score: <span style=\"color:blue;\">" . $userinfo["score"]. "</span></div>";
    
    echo '  <input type="submit" value="Return" class="returnbutton"/>
    </form> ';
    
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $status = trim($_POST['status']);
        if(!empty($status) && $status != null && $status != ""){
            $taskList = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=completeGoal&userid='.$_SESSION['userid'].'&goalid='.$_POST['goalid']);
        }
    }
?>

 <link rel="stylesheet" type="text/css" href="style.css"> 
 <body>

 <link rel="stylesheet" type="text/css" href="style.css"> 
 <body>

<div class=center>
    
    <div class ="logoheader">Goals</div><br><br>
        <?php

        // Get the specific student data
        
        $usergoals = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUserGoals&userid='. $_SESSION['userid']);
        $usergoals = json_decode($usergoals, true);

        for($i = 0; $i < count($usergoals);$i++){
            //echo 'Name:'.$usergoals[$i]["name"].' Status:'.$usergoals[$i]["status"].'<br>';
            
            echo '<form action="Goals.php" method="post" action="">';
            echo '<input type="hidden" value="'. $usergoals[$i]["goalid"] .'" name="goalid" />';
            echo '<input type="hidden" value=1 name="status" />';
            
            if($usergoals[$i]["status"] != 0){
                 //echo "Done!";
                 echo '<input type="submit" value="'. $usergoals[$i]["name"] .'" name="goalname" class="disabled"/><br>';
            }
            else{
                echo '<input type="submit" value="'. $usergoals[$i]["name"] .'" name="goalname" class="button"/><br>';
            }
            echo '<br></form>';
        }




    ?>
</div>
</body>
<!--<br><br>-->
<!--<form action="index.php">-->
<!--    <input type="submit" value="Return" class="button"/>-->
<!--</form> -->