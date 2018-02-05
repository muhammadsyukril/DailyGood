<link rel="stylesheet" type="text/css" href="style.css"> 
<body>
<div class=center>
<?php 
    $userid = $_GET['userid'];
    $user = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUserInfo&userid='.$userid);
    $user = json_decode($user, true);
    echo "<br><br><br>";
    echo '<div class="logoheader">'.$user["name"]." has ".$user["score"]." points</div><br>";
    echo '<div class="header1">Can you beat him?</div>';

    echo '<br></form>';
    //echo "Can you beat him?<br><br>";
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