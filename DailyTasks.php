 <link rel="stylesheet" type="text/css" href="style.css"> 
 <body>

<div class=center>
    Tasks
    <br><br>
    
        <?php
        
        //$_SESSION['username'] = "jee"; 
        $userinfo = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUser&username=test2');
        $userinfo = json_decode($userinfo, true);
        
        if(count($userinfo) > 0){
            $taskList = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getTaskList');
            $taskList = json_decode($taskList, true);

            echo '<button>' . $taskList[0]["name"] .  '</button><br><br>';
            echo '<button>' . $taskList[1]["name"] .  '</button><br><br>';
            echo '<button>' . $taskList[2]["name"] .  '</button><br><br>';
        }
        else {
            echo $userinfo["error"];
        }




    ?>
</div>
</body>
<br><br>
<form action="index.php">
    <input type="submit" value="Return"/>
</form> 