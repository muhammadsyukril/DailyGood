
<?php


 // Include confi.php
 include_once('confi.php');
 if($_SERVER['REQUEST_METHOD'] == "POST"){
     $name = (isset($_POST['name']))?$_POST['name']:'' ;
     $email = (isset($_POST['email']))?$_POST['email']:'';
     $password = (isset($_POST['password']))?$_POST['password']:'';
     $status = (isset($_POST['status']))?$_POST['status']:'';
     
     
     $sql = "CREATE TABLE IF NOT EXISTS users(ID INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT NOT NULL, email CHAR(100) NOT NULL, password CHAR(100) NOT NULL, status TEXT NOT NULL);";
     $qur = mysql_query($sql);
     
     
     // $sql = "INSERT INTO users (`name`, `email`, `password`, `status`) VALUES     ('asd', 'dsa', 'sad', 'asd');";
     // $qur = mysql_query($sql);
     
     
     if($qur) {
         $json = array("status" => 1, "msg" => "Done User added!");
     }
     else {
         $json = array("status" => 0, "msg" => "Error adding user!", "name" => $sql, 'error' => mysql_error());
     }
 } 
 else {
     $json = array("status" => 0, "msg" => "Request method not accepted");
 }
 @mysql_close($conn);
 header('Content-type: application/json');
 echo json_encode($json);
	


?>