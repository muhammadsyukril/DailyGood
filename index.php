
<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: Login.php");
        
    }
    $userinfo = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUserInfo&userid='.$_SESSION['userid']);
    $userinfo = json_decode($userinfo, true);
    //echo "<div class='userinfo'><span style=\"color:blue;\">" . $_SESSION['username']. "</span>  City: <span style=\"color:blue;\">" . $_SESSION['city']. "</span> Score: <span style=\"color:blue;\">" . $userinfo["score"]. "</span></div>";
    echo '
    <form action="Logout.php">';
    echo     "<div class='userinfo'><span style=\"color:blue;\">" . $_SESSION['username']. "</span>  City: <span style=\"color:blue;\">" . $_SESSION['city']. "</span> Score: <span style=\"color:blue;\">" . $userinfo["score"]. "</span></div>";
    
    echo '  <input type="submit" value="Logout" class="returnbutton"/>
    </form> ';

?>
<link rel="stylesheet" type="text/css" href="style.css"> 
<body>
<div class=center>
    <div class ="logoheader">Daily good</div>
    <br><br>
    <form action="DailyTasks.php" method="get">
        <input type="submit" value="Daily tasks" class="button"/>
    </form>    
    <br>
    <form action="Goals.php" method="get">
        <input type="submit" value="Goals" class="button"/>
    </form> 
    <br>
    <form action="Statistics.php" method="get">
        <input type="submit" value="Statistics" class="button"/>
    </form> <br>
    




</div>
</body>

<!--<br><br>-->
<!--<form action="Logout.php">-->
<!--    <input type="submit" value="Logout" class="button"/>-->
<!--</form> -->