<?php

// REST (Representational State Transfer) allows anything to work with your data // that can send a HTTP request

// The most common methods used are GET, POST, PUT, and DELETE
// GET: Used to retrieve data from a resource
// POST: Used to create a new resource, but is considered unsafe
// PUT: Used to update a resource, but is considered unsafe
// DELETE: Used to delete a resource and also is unsafe

function get_student_info($id){
    
    $student_info = array();
    

    $db = new SQLite3('Database.db');
    $result = $db->query('SELECT * FROM users where id = $id;');
    $row = $result->fetchArray();

    $student_info = array("first_name" => $row['name'], "last_name" => $row['email'], "address" => $row['password']);


    
    return $student_info;
    
}

function delete_student_info($id){
    $db = new SQLite3('Database.db');
    $db->exec('DELETE FROM users WHERE id = {$id};');
    header('Location: rest_client.php');  
    
    return get_student_info($id);
}

function get_student_list(){
    
    // Data that normally is pulled from a database
    $db = new SQLite3('Database.db');
    $result = $db->query('SELECT * FROM users');
    $student_list =array();
    while ($row = $result->fetchArray())
    {
        $student_info = array("id" => $row['id'], "name" => $row['name']);
        $student_list[] = $student_info;
    }
    return $student_list;
    
}

// Execute the proper method above based on request
$db = new SQLite3('Database.db');
$query = <<<EOD
CREATE TABLE IF NOT EXISTS users(ID INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT NOT NULL, email CHAR(100) NOT NULL, password CHAR(100) NOT NULL, status TEXT NOT NULL);
INSERT INTO users (`name`, `email`, `password`, `status`) VALUES     ('fsasfa', 'safasf', 'asfasf', 'asfafsafs');
EOD;
$db->exec($query);


if(isset($_GET["action"])){
    
    switch($_GET["action"]){
        
        case "get_student_list":
            $value = get_student_list();
            break;
        
        case "get_student":
            $value = get_student_info($_GET["id"]);
            break;
        case "delete_student":
            $value = delete_student_info($_GET["id"]);
            break;
    }
    
}

exit(json_encode($value));

?>