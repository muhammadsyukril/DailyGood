<?php
$conn = mysql_connect("localhost", "root", "");
mysql_select_db('c9', $conn);

$sql = "Drop Table users";
$qur = mysql_query($sql);

$sql = "CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY, name TEXT NOT NULL, password CHAR(100) NOT NULL);";
$qur = mysql_query($sql);

$sql = "INSERT INTO users VALUES (0,'test1', 'test1');";
$qur = mysql_query($sql);
$sql = "INSERT INTO users VALUES (1,'test2', 'test2');";
$qur = mysql_query($sql);
$sql = "INSERT INTO users VALUES (2,'test3', 'test3');";
$qur = mysql_query($sql);


$sql = "Drop Table tasks";
$qur = mysql_query($sql);
$sql = "CREATE TABLE IF NOT EXISTS tasks(id INTEGER PRIMARY KEY, name CHAR(100) NOT NULL);";
$qur = mysql_query($sql);
$sql = "INSERT INTO tasks VALUES (0,'Ride A bike')";
$qur = mysql_query($sql);
$sql = "INSERT INTO tasks VALUES (1,'Dont watch tv')";
$qur = mysql_query($sql);
$sql = "INSERT INTO tasks VALUES (2,'Dont use car')";
$qur = mysql_query($sql);

$sql = "Drop Table IF EXISTS goals";
$qur = mysql_query($sql);
$sql = "CREATE TABLE IF NOT EXISTS goals(id INTEGER PRIMARY KEY, name CHAR(100) NOT NULL);";
$qur = mysql_query($sql);
$sql = "INSERT INTO goals VALUES (0,'Do all tasks')";
$qur = mysql_query($sql);
$sql = "INSERT INTO goals VALUES (1,'Do 10 tasks in a week')";
$qur = mysql_query($sql);
$sql = "INSERT INTO goals VALUES (2,'Do task everyday')";
$qur = mysql_query($sql);

?>