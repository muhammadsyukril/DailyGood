
<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: Login.php");
        
    }
    echo "Current user:" . $_SESSION['username']. "  Password: " . $_SESSION['password'] . "ID: " . $_SESSION['userid'];
?>
<link rel="stylesheet" type="text/css" href="style.css"> 
<body>
<div class=center>
    Daily good
    <br><br>
    <form action="DailyTasks.php" method="get">
        <input type="submit" value="Daily tasks"/>
    </form>    
    <br><br>
    <form action="Goals.php" method="get">
        <input type="submit" value="Goals"/>
    </form> 
    <br><br>
    <form action="Statistics.php" method="get">
        <input type="submit" value="Statistics" name="jee"/>
    </form> <br><br>
    




</div>
</body>

<br><br>
<form action="Logout.php">
    <input type="submit" value="Logout"/>
</form> 