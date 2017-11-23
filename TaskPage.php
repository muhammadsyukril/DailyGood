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
    
<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        echo $_POST['taskname'].'<br>';

        $status = trim($_POST['status']);
        if(!empty($status) && $status != null && $status != ""){
            $taskList = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=completeTask&userid='.$_SESSION['userid'].'&taskid='.$_POST['taskid']);
            $taskList = json_decode($taskList, true);
        }
    } 
?>
<br>
<?php 
$taskList = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getTaskStatus&userid='.$_SESSION['userid'].'&taskid='.$_POST['taskid']);
$taskList = json_decode($taskList, true);
if($taskList['status'] == 0){
    echo '<form action="TaskPage.php" method="post" action="">
        <input type="hidden" value="'. $_POST['taskname'] .'" name="taskname" />
        <input type="hidden" value="'. $_POST['taskid'] .'" name="taskid" />
        <input type="hidden" value=1 name="status" />
        <input type="submit" value="Complete task"/>
        </form>'    ;
}        
else{
    echo "Task completed!<br>";
}
?>
<br>
<form>
    <input type="submit" value="Facebook"/>
</form>    
<form>
    <input type="submit" value="Twitter"/>
</form> 
<form>
    <input type="submit" value="Google+"/>
</form> <br><br>
</div>
</body>
<br><br>
<form action="DailyTasks.php">
    <input type="submit" value="Return"/>
</form> 