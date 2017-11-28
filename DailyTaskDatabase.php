<?php
 // Include confi.php
include_once('confi.php');

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
		$result = array("id" => $row['id'], "name" => $row['name'], 'password' => $row['password'], 'city' => $row['city'], "status" => 0); 
	}
	if(empty($username)){
	    $result = array("status" => 1, "error" => "Input username!");
	}
	else if(empty($password)){
	    $result = array("status" => 1,"error" => "Input password!");
	}
	else if(count($result) <= 0){
	    $result = array("status" => 1,"error" => "Wrong username or password!");
	}
	return $result;
}

function CreateUser($username, $password,$city){
    $result = GetUser($username, $password);
    $status = array();
    if(count($result) > 0){
        $status = array("status" => 1); 
    }
    else{
        $db = new SQLite3('Database.db');
        $db->query("INSERT INTO users  (name,password,city) VALUES ('".$username."', '".$password."', '".$city."');");
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

function GetRandomTasks($count){
    $taskList = GetTaskList();
    shuffle($taskList);
    $taskListLenght = count($taskList);
    if($count > $taskListLenght){
        $count = $taskListLenght;
    }
    $tasks = array();
    for($i = 0;$i < $count;$i++){
        $tasks[] = $taskList[$i];
    }
    return $tasks;
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

function GetUserGoals($userid){
    CreateUserGoalIfNotExist($userid);

    $db = new SQLite3('Database.db');
    $qur = $db->query("SELECT * FROM usergoal INNER JOIN goals ON usergoal.goalid = goals.id WHERE userid = '".$userid."'");
	$result = array();
	while($row = $qur->fetchArray()){
		$result[] = array("userid" => $row['userid'], "name" => $row['name'], "goalid" => $row['goalid'], "status" => $row['status'], "error" => ""); 
	}
	
	return $result;
    
}

function GetUserTask($userid){
    CreateTaskUserIfNotExist($userid);

    $db = new SQLite3('Database.db');
    $qur = $db->query("SELECT * FROM usertasks WHERE userid = '".$userid."'");
	$result = array();
	while($row = $qur->fetchArray()){
		$result = array("userid" => $row['userid'], "task0" => $row['taskid0'],"task1" => $row['taskid1'],"task2" => $row['taskid2'], "resetdate" => $row['resetdate'], "error" => ""); 
	}
	
   $result = ResetTasksIfOverLimit($result);
	return $result;
    
}

function ResetTasksIfOverLimit($result){
    if(strtotime("now") > $result['resetdate']){
    //if($result['resetdate'] > strtotime("now")){
        $tasks = getRandomTasks(3);
        $resetdate = strtotime("+1 day");
        $userid = $result["userid"];
        $db = new SQLite3('Database.db');
        $qur = $db->query("UPDATE usertasks SET taskid0 = ".$tasks[0]["id"].",taskid1 = ".$tasks[1]["id"].",taskid2 = ".$tasks[2]["id"].", resetdate = ".$resetdate." WHERE userid = ".$result['userid']);

        $db->query("UPDATE usertask SET status = 0 WHERE userid = ".$userid);

        
        $result = array("userid" => $result["userid"], "task0" => $tasks[0]["id"],"task1" => $tasks[1]["id"],"task2" => $tasks[2]["id"], "resetdate" => $date, "error" => "Tasks reseted!"); 
    } 
    return $result;
}
function ResetTasks($userid){
    $db = new SQLite3('Database.db');
    $db->query("UPDATE usertask SET status = 0 WHERE userid = ".$userid);
    return array();

}


function GetTaskStatus($userid, $taskid){
    $db = new SQLite3('Database.db');
    $qur = $db->query("INSERT OR IGNORE INTO usertask  (userid,taskid) VALUES ('".$userid."', '".$taskid."');");
    $qur = $db->query("SELECT * FROM usertask INNER JOIN tasks ON usertask.taskid = tasks.id  WHERE userid = '".$userid."' AND taskid = '".$taskid."'");
	$result = array();
	while($row = $qur->fetchArray()){
		$result = array('status' => $row['status'], 'name' => $row['name']); 
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
	    $qur = $db->query("SELECT * FROM tasks WHERE id = '".$taskid."'"); 
    	while($row = $qur->fetchArray()){
		    $scoreToGive = $row['scoretogive']; 
	    }
	    

	    
	    $scoreToGive = $score + $scoreToGive;
	    $qur = $db->query("UPDATE userinfo SET score = ".$scoreToGive." WHERE userid = '".$userid."'");
	    
	}
	
    $result = array('status' => $row['status'], "score" => $score, "scoretogive" => $scoreToGive);

	return $result;

}
function CompleteGoal($userid, $goalid){
    CreateUserGoalIfNotExist($userid);
    $db = new SQLite3('Database.db');
    $qur = $db->query("UPDATE usergoal SET status = 1 WHERE userid = '".$userid."' AND goalid = '".$goalid."'");
    $qur = $db->query("SELECT * FROM usergoal WHERE userid = '".$userid."' AND goalid = '".$goalid."'");
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
	    $qur = $db->query("SELECT * FROM goals WHERE id = '".$taskid."'"); 
    	while($row = $qur->fetchArray()){
		    $scoreToGive = $row['scoretogive']; 
	    }
	    

	    
	    $scoreToGive = $score + $scoreToGive;
	    $qur = $db->query("UPDATE userinfo SET score = ".$scoreToGive." WHERE userid = '".$userid."'");
	    
	}
	
    $result = array('status' => 1, "score" => $score, "scoretogive" => $scoreToGive);

	return $result;

}

function CreateUserGoalIfNotExist($userid){
    $goalList = getGoalList();
    $db = new SQLite3('Database.db');
    foreach($goalList as $goal){
        $qur = $db->query("INSERT OR IGNORE INTO usergoal  (userid,goalid) VALUES ($userid ,". $goal['id'].");");
    }
    $status = array("status" => 0); 


    return $status;
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
    $resetdate = strtotime("+1 day");

    $tasks = getRandomTasks(3);

    if(count($result) == 0){
        $db = new SQLite3('Database.db');
        $qur = $db->query("INSERT INTO usertasks  (userid,taskid0,taskid1,taskid2,resetdate) VALUES ($userid , ".$tasks[0]["id"].", ". $tasks[1]["id"] .",". $tasks[2]["id"] .",'$resetdate');");
        $status = array("status" => 0); 

    }

    return $status;
}

function GetUserInfo($userid){
    $db = new SQLite3("Database.db");
    $qur = $db->query("INSERT OR IGNORE INTO userinfo  (userid) VALUES ('".$userid."');");
    $qur = $db->query("SELECT * FROM users INNER JOIN userinfo ON users.id = userinfo.userid WHERE users.id = ". $userid);
    while($row = $qur->fetchArray()){
        $result = array("score" => $row["score"], "city" => $row["city"], "completedtasks" => $row["completedtasks"], "completedgoals" => $row["completedgoals"]);
    }
    return $result;
}

function GetCityScore($city){
    $db = new SQLite3("Database.db");
    $qur = $db->query("SELECT * FROM users LEFT OUTER JOIN userinfo ON users.id = userinfo.userid where city = '". $city."'");

    $score = 0;
    $count = 0;
	while($row = $qur->fetchArray()){
		$count++;
		$score += $row["score"];
	}
	
	$result = array("totalscore" => $score, "usercount" => $count);
	return $result;
}

// Execute the proper method above based on request

if(isset($_GET["action"])){
    date_default_timezone_set('Europe/Helsinki');
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
        case "getUser":
            $value = GetUser($_GET["username"],$_GET["password"]);
            break;
        case "createUser":
            $value = CreateUser($_GET["username"],$_GET["password"],$_GET["city"]);
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
        case "getRandomTasks":
            $value = GetRandomTasks($_GET["count"]);
            break;
        case "completeTask":
            $value = SetTaskStatus($_GET["userid"],$_GET["taskid"]);
            break;
        case "completeGoal":
            $value = CompleteGoal($_GET["userid"],$_GET["goalid"]);
            break;
        case "getUserInfo":
            $value = GetUserInfo($_GET["userid"]);
            break;
        case "getUserGoals":
            $value = GetUserGoals($_GET["userid"]);
            break;
        case "GetCityScore":
            $value = GetCityScore($_GET["city"]);
            break;

    }
    
}

exit(json_encode($value));

?>