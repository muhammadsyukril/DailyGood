 <?php
    session_start();
    if(empty($_SESSION['username'])){
        header("location: Login.php");
        
    }
    $userinfo = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getUserInfo&userid='.$_SESSION['userid']);
    $userinfo = json_decode($userinfo, true);
    //echo "<div class='userinfo'><span style=\"color:blue;\">" . $_SESSION['username']. "</span>  City: <span style=\"color:blue;\">" . $_SESSION['city']. "</span> Score: <span style=\"color:blue;\">" . $userinfo["score"]. "</span></div>";

    echo '
    <form action="DailyTasks.php">';
    echo     "<div class='userinfo'><span style=\"color:blue;\">" . $_SESSION['username']. "</span>  City: <span style=\"color:blue;\">" . $_SESSION['city']. "</span> Score: <span style=\"color:blue;\">" . $userinfo["score"]. "</span></div>";
    
    echo '  <input type="submit" value="Return" class="returnbutton"/>
    </form> ';?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>

<link rel="stylesheet" type="text/css" href="style.css"> 
<body>
<div class=center>
    
<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        echo '<div class="logoheader">'.$_POST['taskname'].'<div>';

        $status = trim($_POST['status']);
        if(!empty($status) && $status != null && $status != ""){
            $taskList = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=completeTask&userid='.$_SESSION['userid'].'&taskid='.$_POST['taskid']);
            $taskList = json_decode($taskList, true);
            echo '<div class="header">';
            echo "Task completed!";
            echo '</div>';
            echo "<br>";
        }
        else{
            $taskList = file_get_contents('https://software-as-a-service-wawethewaras.c9users.io/DailyTaskDatabase.php?action=getTaskStatus&userid='.$_SESSION['userid'].'&taskid='.$_POST['taskid']);
            $taskList = json_decode($taskList, true);
            if($taskList['status'] == 0){
                echo '<form action="TaskPage.php" method="post" action="">
                <input type="hidden" value="'. $_POST['taskname'] .'" name="taskname" />
                <input type="hidden" value="'. $_POST['taskid'] .'" name="taskid" />
                <input type="hidden" value=1 name="status" />
                <input type="submit" value="Complete task" class="button"/>
                </form>'    ;
            }  
            else{
                echo "Task completed!<br>";
            }
                
        }
    } 
    else{
        header("location: DailyTasks.php");
    }


echo '<form>
<div class="fb-share-button" data-href="https://software-as-a-service-wawethewaras.c9users.io/TaskShare.php?taskid='.$_POST['taskid'].'" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fsoftware-as-a-service-wawethewaras.c9users.io%2FTaskShare.php%3Ftaskid%3D0&amp;src=sdkpreparse">Share</a></div></form>    
<form>';

echo '<a class="twitter-share-button"
  href="https://twitter.com/intent/tweet?text=Join"
  data-size="large"
  <link rel="canonical"
  href="https://software-as-a-service-wawethewaras.c9users.io/TaskShare.php?taskid='.$_POST['taskid'].'">
  >
Tweet</a>
</form> ';
?>
<form>
    <div class="g-plus" data-action="share"></div>
</form> <br>
</div>
</body>
<br>
<!--<form action="DailyTasks.php">-->
<!--    <input type="submit" value="Return" class="button"/>-->
<!--</form> -->