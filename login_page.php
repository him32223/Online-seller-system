<?php
session_start();
include_once('include/db.php');

//check if button login is click
if(isset($_POST['submit'])){
  //check username and password is not empty
  if(!empty($_POST['username']) && !empty($_POST['psw'])){
    //get the data using $_POST[], inside the $_POST[] is the name inside the input tag
    $Username=$_POST['username'];
    $Password=$_POST['psw'];
    //select query to check the username and password is match or not
    $Query="SELECT * FROM tb_login WHERE Username='".$Username."' AND Password='".$Password."'";
    $result=mysqli_query($conn,$Query);
    $rows=mysqli_num_rows($result);
    $row=mysqli_fetch_array($result);
    //if the username and password is match then to this
    if($rows==1){
      $_SESSION['username']=$Username;
      $_SESSION['password']=$Password;
      $_SESSION['permission']=$row['Permission'];
      $_SESSION["id"]=$row[0];
      echo "<script>window.location.href = 'index.php';
            alert('Successfully Login.');</script>";
    //if the username or password is wrong then to this
    }else{      
      echo "<script>alert('Wrong Username or Password!Please try again.');</script>";
    }
  //if the usernmae or password is empty then do below
  }else{
    echo "<script>alert('Please Insert Username or Password');</script>";
  }
}
?>
<style>
 input {
  width: 100%;
  padding: 12px;
  border: none;
  border-bottom: 1px solid blue;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  background-color: transparent;
}
.rainbow-bg{
    animation: rainbow-bg 2.5s linear;
    animation-iteration-count: infinite;
}

.rainbow{
    animation:  2.5s linear;
    animation-iteration-count: infinite;
}

@keyframes rainbow-bg{
  
    8%{
      background-color: rgb(255,127,0);
    }
    16%{
      background-color: rgb(255,255,0);
    }
    25%{
      background-color: rgb(127,255,0);
    }
    33%{
      background-color: rgb(0,255,0);
    }
    41%{
      background-color: rgb(0,255,127);
    }
    50%{
      background-color: rgb(0,255,255);
    }
    58%{
      background-color: rgb(0,127,255);
    }
    66%{
      background-color: rgb(0,0,255);
    }
    75%{
      background-color: rgb(127,0,255);
    }
    83%{
      background-color: rgb(255,0,255);
    }
    91%{
      background-color: rgb(255,0,127);
    }
}

@keyframes rainbow{
    100%,0%{
      color: rgb(255,0,0);
    }
    8%{
      color: rgb(255,127,0);
    }
    16%{
      color: rgb(255,255,0);
    }
    25%{
      color: rgb(127,255,0);
    }
    33%{
      color: rgb(0,255,0);
    }
    41%{
      color: rgb(0,255,127);
    }
    50%{
      color: rgb(0,255,255);
    }
    58%{
      color: rgb(0,127,255);
    }
    66%{
      color: rgb(0,0,255);
    }
    75%{
      color: rgb(127,0,255);
    }
    83%{
      color: rgb(255,0,255);
    }
    91%{
      color: rgb(255,0,127);
    }
}

/* Style the submit button */
input[type=submit] {
  background-color: #4CAF50;
  color: black;
}

/* Style the container for inputs */
.container {
  background-color: #f1f1f1;
  padding: 2px;
}

.control-group {
  background-color: #f1f1f1;
  padding: 2px;
}
 

</style>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<div class="container">
	<h1>Login</h1>
  <form action="login_page.php" method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required><br>

    <label for="psw">Password</label>
    <input type="password" id="psw" name="psw" required><br>

    <div class="control-group">
    <label class="control-lable">Permission</label>
    <div class="controls">
      <input type="text" name="permission" placeholder="Permission">
    </div>
  </div>


    <input class="rainbow-bg" type="submit" value="Login" name="submit">
    <input class="rainbow-bg" type="button" value="Register" name="register" onclick="window.location.href='register.php'">
  </form>
</div>
</body>
</html>