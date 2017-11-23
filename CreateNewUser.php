<?php 
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        

        $userinfo = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=createUser&username='.$username.'&password='.$password);
        $userinfo = json_decode($userinfo, true);
        
        if(count($status) == 0){
            // $_SESSION['username'] = $username;
            // $_SESSION['password'] = $password;
            header("location: index.php");
                
        }
    }
?>

<link rel="stylesheet" type="text/css" href="style.css"> 
<body>
<div class=center>
    Create new user
    <br><br>
    
    <form action="" method="post" > 
        Username:
        <input type="field" name='username' id='username'/> <br><br>
        Password:
        <input type="field" name='password' id='password'/><br><br>
        <input type="submit" value="Create user"/>
    </form> 

</div>
</body>

<?php 
    // $userinfo = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUserList');
    // $userinfo = json_decode($userinfo, true);
    // foreach($userinfo as $item) { //foreach element in $arr
    //     echo "ID: ". $item["id"] . " Username: ". $item["name"] . " Password: ". $item["password"] ."<br>";
    // }


?>