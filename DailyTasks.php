 <link rel="stylesheet" type="text/css" href="style.css"> 
 <body>

<div class=center>
    Tasks
    <br><br>
    
        <?php
        

        $taskList = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getTaskList');
        $taskList = json_decode($taskList, true);

        echo '<button>' . $taskList[0]["name"] .  '</button><br><br>';
        echo '<button>' . $taskList[1]["name"] .  '</button><br><br>';
        echo '<button>' . $taskList[2]["name"] .  '</button><br><br>';





    ?>
</div>
</body>
<br><br>
<form action="index.php">
    <input type="submit" value="Return"/>
</form> 