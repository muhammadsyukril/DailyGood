<link rel="stylesheet" type="text/css" href="style.css"> 
<body>
<div class=center>
<?php 
    $taskid = $_GET['taskid'];
    $task = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getTask&taskid='.$taskid);
    $task = json_decode($task, true);
    echo "<br><br><br>";
    echo "Friend wants you to<br>";
    echo '<div class="logoheader">'. $task["name"] .'</div>';

    echo '<br></form>';
    echo "Join to help enviroment!<br><br>";
?>

<form action="CreateNewUser.php" >
    <input type="submit" value="Create new user" class="createuserbutton"/>
</form> 
<form action="Login.php" >
    <input type="submit" value="Login" class="createuserbutton"/>
</form> 
</div>
</body>
<br><br>