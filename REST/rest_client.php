<html>
<body>
<?php

// Check if one of the student name links was clicked

if(isset($_GET["action"]) == "get_student"){
    
    // Get the specific student data
    
    $student_info = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/api.php?action=get_student&id=' . $_GET["id"]);
    
    // Decode from JSON into an array
    
    $student_info = json_decode($student_info, true);
    
?>

First Name : <?php echo $student_info["first_name"] ?><br />
Last Name : <?php echo $student_info["last_name"] ?><br />
Address : <?php echo $student_info["address"] ?><br />

<?php

}

 else // else print out the list of students
 
 {
    
    // Call the method get_student_list in the API to get the list
    
    $student_list = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/api.php?action=get_student_list');
    
    // Convert from JSON and into an array
    
    $student_list = json_decode($student_list, true);
    
?>

<!-- Cycle through the student list and print them out with the correct id -->

<?php foreach($student_list as $student): ?>

<a href=<?php echo
"https://software-as-a-service-wawethewaras.c9users.io/api.php?action=get_student&id=" . $student["id"] ?>><?php echo $student["name"] ?></a> <a href=<?php echo
"https://software-as-a-service-wawethewaras.c9users.io/api.php?action=delete_student_info&id=" . $student["id"] ?>>Delete</a><button>Update</button><br>
 
 <?php 
 endforeach; ?>
 
 <?php
    
 } ?>
<button>Create new</button>
</body>
</html>