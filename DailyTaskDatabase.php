<?php
 // Include confi.php
 include_once('confi.php');
// REST (Representational State Transfer) allows anything to work with your data // that can send a HTTP request


function GetUserList(){
    $db = new SQLite3('Database.db');
    $qur = $db->query('SELECT * FROM users');
	$result = array();
	while($row = $qur->fetchArray()){
		$result[] = array("id" => $row['id'], "name" => $row['name'], 'password' => $row['password']); 
	}
	return $result;
    
}

function GetUser($username, $password){
    $db = new SQLite3('Database.db');
    $qur = $db->query("SELECT * FROM users WHERE name = '".$username."' AND password = '".$password."'");
	$result = array();
	while($row = $qur->fetchArray()){
		$result = array("id" => $row['id'], "name" => $row['name'], 'password' => $row['password']); 
	}
	return $result;

}
function CreateUser($username, $password){
    $result = GetUser($username, $password);
    $status = array();
    if(count($result) > 0){
        $status = array("status" => 1); 
    }
    else{
        $db = new SQLite3('Database.db');
        $qur = $db->query("INSERT INTO users  (name,password) VALUES ('".$username."', '".$password."');");
        $status = array("status" => 0); 

    }

    return $status;
}
function GetTaskList(){
    
    $db = new SQLite3('Database.db');
    $qur = $db->query('SELECT * FROM tasks');
	$result = array();
	while($row = $qur->fetchArray()){
		$result[] = array("id" => $row['id'], "name" => $row['name'], "scoretogive" => $row['scoretogive']); 
	}
	return $result;
    
}

function GetTask($taskid){
    
    $db = new SQLite3('Database.db');
    $qur = $db->query('SELECT * FROM tasks WHERE id = '. $taskid);
	$result = "";
	while($row = $qur->fetchArray()){
		$result = array("id" => $row['id'], "name" => $row['name'], "scoretogive" => $row['scoretogive']); 
	}
	return $result;
    
}
function GetRandomTask(){
	$taskCount = count(GetTaskList());
	$randomint = rand(0, $taskCount-1);
	$randomtask = GetTask($randomint);
	return $randomtask;
    
}

function GetGoalList(){
    
    $db = new SQLite3('Database.db');
    $qur = $db->query('SELECT * FROM goals');
	$result = array();
	while($row = $qur->fetchArray()){
		$result[] = array("id" => $row['id'], "name" => $row['name'], "scoretogive" => $row['scoretogive']); 
	}
	return $result;

}

function GetGoal($goalid){
    
    $db = new SQLite3('Database.db');
    $qur = $db->query('SELECT * FROM goals WHERE id = '. $goalid);
	$result = "";
	while($row = $qur->fetchArray()){
		$result = array("id" => $row['id'], "name" => $row['name'], "scoretogive" => $row['scoretogive']); 
	}
	return $result;
    
}

function GetUserTask($userid){
    CreateTaskUserIfNotExist($userid);

    $db = new SQLite3('Database.db');
    $qur = $db->query("SELECT * FROM usertasks WHERE userid = '".$userid."'");
	$result = array();
	while($row = $qur->fetchArray()){
		$result = array("userid" => $row["userid"], "task1" => $row['taskid1'],"task2" => $row['taskid2'],"task3" => $row['taskid3'], "date" => $row['date'], "time" => $row['time']); 
	}
	
	//if date > seuraava päivä then get new tasks
	
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
     $student_info = array("taskname" => "Do laundry", "score" => 2); 
    return $student_info;
    
}




function GetTaskStatus($username, $taskid){
    $db = new SQLite3('Database.db');
    $qur = $db->query("INSERT OR IGNORE INTO usertask  (userid,taskid) VALUES ('".$username."', '".$taskid."');");
    $qur = $db->query("SELECT * FROM usertask WHERE userid = '".$username."' AND taskid = '".$taskid."'");
	$result = array();
	while($row = $qur->fetchArray()){
		$result = array('status' => $row['status']); 
	}
	return $result;

}
function SetTaskStatus($userid, $taskid){
    $db = new SQLite3('Database.db');
    $qur = $db->query("UPDATE usertask SET status = 1 WHERE userid = '".$userid."' AND taskid = '".$taskid."'");
    $qur = $db->query("SELECT * FROM usertask WHERE userid = '".$userid."' AND taskid = '".$taskid."'");
	$result = array();
    $score = 0;
    $scoreToGive = 0;



	while($row = $qur->fetchArray()){
		$result = array('status' => $row['status']); 
	}
	if(count($result) == 0){
	    return array('status' => 0); 
	}
	else {
	    $qur = $db->query("SELECT * FROM userinfo WHERE userid = '".$userid."'");
    	while($row = $qur->fetchArray()){
		    $score = $row['score']; 
	    }
	    $qur = $db->query("SELECT * FROM tasks WHERE taskid = '".$taskid."'"); 
    	while($row = $qur->fetchArray()){
		    $scoreToGive = $row['scoretogive']; 
	    }
	    

	    
	    $scoreToGive = $score + $scoreToGive;
	    $qur = $db->query("UPDATE userinfo SET score = ".$scoreToGive." WHERE userid = '".$userid."'");
	    
	}
    $result = array('status' => $row['status'], "score" => $score, "scoretogive" => $scoreToGive);

	return $result;

}

function CreateTaskUserIfNotExist($userid){
    $db = new SQLite3('Database.db');
    $qur = $db->query("SELECT * FROM usertasks WHERE userid = ".$userid);
	$result = array();
	while($row = $qur->fetchArray()){
		$result[] = array("userid" => $row['userid']); 
	}
	
    $status = array();
    date_default_timezone_set('Europe/Helsinki');
    $note = $_POST["message"];
    $date = date("d.m.y");
    $time = date("H:i");
    
    $tasks = array();
    $tasklistLength = count(GetTaskList());
    $tasks["task1"] = rand(0,$tasklistLength-1);
    $tasks["task2"] = rand(0,$tasklistLength-1);
    $tasks["task3"] = rand(0,$tasklistLength-1);
    
    if(count($result) == 0){
        $db = new SQLite3('Database.db');
        $qur = $db->query("INSERT INTO usertasks  (userid,taskid1,taskid2,taskid3,date,time) VALUES ($userid , ".$tasks["task1"].", ". $tasks["task2"] .",". $tasks["task3"] .",'$date', '$time');");
        $status = array("status" => 0); 

    }

    return $status;
}

function GetUserInfo($userid){
    $db = new SQLite3("Database.db");
    $qur = $db->query("INSERT OR IGNORE INTO userinfo  (userid,city) VALUES ('".$userid."', 'Lahti');");
    $qur = $db->query("SELECT * FROM userinfo WHERE userid = ". $userid);
    while($row = $qur->fetchArray()){
        $result = array("score" => $row["score"], "city" => $row["city"], "completedtasks" => $row["completedtasks"], "completedgoals" => $row["completedgoals"]);
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
        case "getUserList":
            $value = GetUserList();
            break;
        case "getCityStatistics":
            $value = GetCityStatistics($_GET["city"]);
            break;
        case "getUser":
            $value = GetUser($_GET["username"],$_GET["password"]);
            break;
        case "createUser":
            $value = CreateUser($_GET["username"],$_GET["password"]);
            break;
        case "getUserTask":
            $value = GetUserTask($_GET["userid"]);
            break;
        case "getTaskStatus":
            $value = GetTaskStatus($_GET["userid"],$_GET["taskid"]);
            break;
        case "getTask":
            $value = GetTask($_GET["taskid"]);
            break;
        case "completeTask":
            $value = SetTaskStatus($_GET["userid"],$_GET["taskid"]);
            break;
        case "getUserInfo":
            $value = GetUserInfo($_GET["userid"]);
            break;
    }
    
}

exit(json_encode($value));

?>