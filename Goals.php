 <link rel="stylesheet" type="text/css" href="style.css"> 
 <body>

<div class=center>
    Goals
    <br><br>
    
        <?php

        // Get the specific student data
        
        $student_info = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getGoalList&id=1');
        
        // Decode from JSON into an array
        
        $student_info = json_decode($student_info, true);
        echo '<button>' . $student_info[0]["name"] .  '</button><br><br>';
        echo '<button>' . $student_info[1]["name"] .  '</button><br><br>';
        echo '<button>' . $student_info[2]["name"] .  '</button><br><br>';



    ?>
</div>
</body>
<br><br>
<form action="index.php">
    <input type="submit" value="Return"/>
</form> 