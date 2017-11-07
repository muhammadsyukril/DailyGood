<?php 
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        echo "Username:" . $username ." Password: ".$password;

        
        $userinfo = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUser&username='.$username.'&password='.$password);
        $userinfo = json_decode($userinfo, true);
        
        if(count($userinfo) > 0){
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("location: index.php");
            
        }
    }
?>


<link rel="stylesheet" type="text/css" href="style.css"> 
<body>
<div class=center>
    Login screen
    <br><br>
    
    <form action="" method="post" > 
        Username:
        <input type="field" name='username' id='username'/> <br><br>
        Password:
        <input type="field" name='password' id='password'/><br><br>
        <input type="submit" value="Login"/>
    </form> 
    <br>
    <form action="CreateNewUser.php" >
        <input type="submit" value="Create new user"/>
    </form> 
</div>
</body>


