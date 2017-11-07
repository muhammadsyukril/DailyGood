<?php  session_start(); ?>
<html><body>
    <?php
$db = new SQLite3('Database.db');
$id = $_POST["delete"];
$id = (int)$id;
$query = <<<EOD
    DELETE FROM notepad WHERE id = '$id';
EOD;
$db->exec($query);
//echo $id;
//header('Location: Notepad.php');  
?>
</body>
</html>