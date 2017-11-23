 <?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: Login.php");
        
    }
    $userinfo = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUserInfo&userid='.$_SESSION['userid']);
    $userinfo = json_decode($userinfo, true);
    echo "Current user:" . $_SESSION['username']. "  City: " . $userinfo['city'] . " Score: " . $userinfo['score'];
?>

 <link rel="stylesheet" type="text/css" href="style.css"> 
 <body>

<div class=center>
    Tasks
    <br><br>
    
        <?php
        session_start();
        $taskList = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUserTask&userid='.$_SESSION['userid']);
        $taskList = json_decode($taskList, true);
        echo "Tasks reset: " . $taskList['time'] ."  ". $taskList['date'] .'<br><br>';
        


        echo '<form action="TaskPage.php" method="post" action="">';
        $taskname = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getTask&taskid='.$taskList["task1"]);
        $taskname = json_decode($taskname, true);
            echo '<input type="hidden" value="'. $taskList["task1"] .'" name="taskid" />';
            echo '<input type="submit" value="'. $taskname["name"] .'" name="taskname" /><br><br>';
        echo '</form>';
        
        echo '<form action="TaskPage.php" method="post" action="">';
        $taskname = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getTask&taskid='.$taskList["task2"]);
        $taskname = json_decode($taskname, true);
            echo '<input type="hidden" value="'. $taskList["task2"] .'" name="taskid" />';
            echo '<input type="submit" value="'. $taskname["name"] .'" name="taskname" /><br><br>';
        echo '</form>';
        
        echo '<form action="TaskPage.php" method="post" action="">';
        $taskname = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getTask&taskid='.$taskList["task3"]);
        $taskname = json_decode($taskname, true);
            echo '<input type="hidden" value="'. $taskList["task3"] .'" name="taskid" />';
            echo '<input type="submit" value="'. $taskname["name"] .'" name="taskname" /><br><br>';
        echo '</form>';
    ?>
</div>
</body>
<br><br>
<form action="index.php">
    <input type="submit" value="Return"/>
</form> 