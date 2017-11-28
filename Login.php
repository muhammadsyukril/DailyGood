<?php 
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        $userinfo = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUser&username='.$username.'&password='.$password);
        $userinfo = json_decode($userinfo, true);
        
        if($userinfo["status"] == 0){
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['city'] = $userinfo['city'];
            $_SESSION['userid'] = $userinfo['id'];
            header("location: index.php");
            
        }
        else{
            $errorMessage = $userinfo["error"];
        }
    }
?>


<link rel="stylesheet" type="text/css" href="style.css"> 
<body>
<div class=center>
    
    <div class ="logoheader">Daily good</div>
    <br><br>
    <?php 
        if($userinfo["status"] != 0){
            echo $errorMessage."<br><br>"; 
        }
        
    ?>
    
    <form action="" method="post" > 
        <input type="field" name='username' id='username' placeholder="Username" class ="inputfield"/> <br><br>
        <input type="password" name='password' id='password' placeholder="Password" class ="inputfield"/><br><br>
        <input type="submit" value="Login" class="button"/>
    </form> 
    <br>
    <form action="CreateNewUser.php" >
        <input type="submit" value="Create new user" class="createuserbutton"/>
    </form> 
</div>
</body>

