 <link rel="stylesheet" type="text/css" href="style.css"> 
 <body>

<div class=center>
    <?php

        // Get the specific student data
        
        $student_info = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getCityStatistics&city=Lahti');
        
        // Decode from JSON into an array
        $student_info = json_decode($student_info, true);
        
        echo 'City score is ' . $student_info["score"] . '!';

    ?>
    
</div>
</body>

<br><br>
<form action="index.php">
    <input type="submit" value="Return"/>
</form> 