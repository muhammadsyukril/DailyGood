  <?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: Login.php");
        
    }
    $userinfo = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUserInfo&userid='.$_SESSION['userid']);
    $userinfo = json_decode($userinfo, true);
    //echo "Current user:" . $_SESSION['username']. "  City: " . $_SESSION['city'] . " Score: " . $userinfo['score'];
    echo '
    <form action="index.php">';
    echo     "<div class='userinfo'><span style=\"color:blue;\">" . $_SESSION['username']. "</span>  City: <span style=\"color:blue;\">" . $_SESSION['city']. "</span> Score: <span style=\"color:blue;\">" . $userinfo["score"]. "</span></div>";
    
    echo '  <input type="submit" value="Return" class="returnbutton"/>
    </form> ';

?>

 <link rel="stylesheet" type="text/css" href="style.css"> 
 <body>

<div class=center>
    <?php

        // Get the specific student data
        
        $cityStatistics = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=GetCityScore&city='.$_SESSION['city']);
        // Decode from JSON into an array
        $cityStatistics = json_decode($cityStatistics, true);
        echo '<div class="logoheader">';
        echo $_SESSION['city'] . "<br>";
        echo '</div>';
        echo '<div class="header">';
        
        echo 'City score is ' . $cityStatistics["totalscore"] . '!<br>';
        echo 'Users in city: ' . $cityStatistics["usercount"] . '!<br>';
        echo "</div>";
    ?>
    
</div>
</body>

<!--<br><br>-->
<!--<form action="index.php">-->
<!--    <input type="submit" value="Return" class="button"/>-->
<!--</form> -->