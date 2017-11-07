<?php
 // Include confi.php
 include_once('confi.php');
// REST (Representational State Transfer) allows anything to work with your data // that can send a HTTP request

// The most common methods used are GET, POST, PUT, and DELETE
// GET: Used to retrieve data from a resource
// POST: Used to create a new resource, but is considered unsafe
// PUT: Used to update a resource, but is considered unsafe
// DELETE: Used to delete a resource and also is unsafe

function GetTaskList(){
    
    $qur = mysql_query("select * from tasks");
	$result = array();
	while($r = mysql_fetch_array($qur)){
		extract($r);
		$result[] = array("id" => $id, "name" => $name); 
	}
	return $result;
    
}

function GetGoalList(){
    
    $qur = mysql_query("select * from 'goals'");
    $result = array();
    while($r = mysql_fetch_array($qur)){
    	extract($r);
    	$result[] = array("id" => $id, "name" => $name); 
    }
    return $result;

}

function GetCityStatistics($id){
    
    $student_info = array();
    
    // Data that normally is pulled from a database
    switch($id){
        
        case "Lahti":
            $student_info = array("taskname" => "Do laundry", "score" => 0); 
            break;
        case "Lappeenranta":
            $student_info = array("taskname" => "Do laundry", "score" => 2); 
            break;
    }
    
    return $student_info;
    
}


function GetUser($username, $password){

//     $qur = mysql_query("select * from `users` where 'name' = '".$username."'");
// 	$result =array();
// 	while($r = mysql_fetch_array($qur)){
// 		extract($r);
// 		$result[] = array("id" => $id, "name" => $name, "password" => $password); 
// 	}
// 	return $json = array("status" => 1, "info" => $result);

    $qur = mysql_query("select * from users where name = '".$username."'");
    $result = array();
    while($r = mysql_fetch_array($qur)){
    	extract($r);
    	$result[] = array("id" => $id, "name" => $name); 
    }
    return $result;
}

// Execute the proper method above based on request

if(isset($_GET["action"])){
    
    switch($_GET["action"]){
        
        case "getTaskList":
            $value = GetTaskList();
            break;
        case "getGoalList":
            $value = GetGoalList();
            break;
        case "getCityStatistics":
            $value = GetCityStatistics($_GET["city"]);
            break;
        case "getUser":
            $value = GetUser($_GET["username"],$_GET["username"]);
            break;
        
    }
    
}

exit(json_encode($value));

?>