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
?>

 <link rel="stylesheet" type="text/css" href="style.css"> 
 <body>
     
     



<div class=center>
    
    <div class ="logoheader">Tasks</div>
    <br>
    <?php
        session_start();
        $taskList = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUserTask&userid='.$_SESSION['userid']);
        $taskList = json_decode($taskList, true);
        date_default_timezone_set('Europe/Helsinki');
        $time = date("h:i d.m",$taskList["resetdate"]);
        if(empty($taskList["error"])){
            echo '<div>Task reset at ' . $time . '</div><br>';
        }
        else{
            echo '<div>'.$taskList["error"].'</div><br>';

        }
        
        $task = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getTaskStatus&userid='.$_SESSION['userid'].'&taskid='.$taskList["task0"]);
        $task = json_decode($task, true);
        echo '<form action="TaskPage.php" method="post" action="">';
        echo '<input type="hidden" value="'. $taskList["task0"] .'" name="taskid" />';
        if($task['status'] != 0){
            echo '<input type="submit" value="'. $task["name"] .'" name="taskname" class="donebutton"/>';
            //echo " Done!";
            
        }
        else{
            echo '<input type="submit" value="'. $task["name"] .'" name="taskname" class="button"/><br>';
    
        }
        echo '<br></form>';
    
        $task = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getTaskStatus&userid='.$_SESSION['userid'].'&taskid='.$taskList["task1"]);
        $task = json_decode($task, true);
        echo '<form action="TaskPage.php" method="post" action="">';
        echo '<input type="hidden" value="'. $taskList["task1"] .'" name="taskid" />';
        if($task['status'] != 0){
            echo '<input type="submit" value="'. $task["name"] .'" name="taskname" class="donebutton"/>';
            //echo " Done!";
            
        }
        else{
            echo '<input type="submit" value="'. $task["name"] .'" name="taskname" class="button"/><br>';
    
        }
        echo '<br></form>';
        
        $task = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getTaskStatus&userid='.$_SESSION['userid'].'&taskid='.$taskList["task2"]);
        $task = json_decode($task, true);
        echo '<form action="TaskPage.php" method="post" action="">';
        echo '<input type="hidden" value="'. $taskList["task2"] .'" name="taskid" />';
        if($task['status'] != 0){
            echo '<input type="submit" value="'. $task["name"] .'" name="taskname" class="donebutton"/>';
            //echo " Done!";
            
        }
        else{
            echo '<input type="submit" value="'. $task["name"] .'" name="taskname" class="button"/><br>';
    
        }
        echo '<br></form>';
        echo '<br>';
        
    ?>
</div>
<!--<br><br>-->
<!--<form action="index.php">-->
<!--    <input type="submit" value="Return" class="button"/>-->
    
<!--</form> -->