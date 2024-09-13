<?php
    include("classes/connect.php");
    include("classes/signup.php");
     
    
    $name = "";
    $email = "";
    $contact = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $signup = new Signup();
        $result = $signup->evaluate($_POST);

        if($result != ""){
            
            echo "<div style='text-align:center; font-size: 12px;color:white;background-color:grey;'>";
			echo "<br>The following errors occured:<br><br>";
			echo $result;
			echo "</div>";
        }else{

            header("Location: login_beta.php");
            die;
        }

        $name = $_POST['name'];
        $email =$_POST['email'] ;
        $contact = $_POST['contact'];
    
        
    }

   

?>
<html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Movie Theater | Signup </title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="center">
      <h1>Signup</h1>
      <form method="post">
      <div class="txt_field">
          <input name="name" type="text" >
          <span></span>
          <label>Fullname</label>
        </div>
        <div class="txt_field">
          <input name="email" type="text" >
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input name="contact" type="text" >
          <span></span>
          <label>Contact</label>
        </div>
        <div class="txt_field">
          <input name="password" type="password" >
          <span></span>
          <label>Password</label>
        </div>
        
        <input type="submit" value="SignUp">
        <div class="signup_link">
         Already a member? <a href="login_beta.php">Login</a>
        </div>
      </form>
    </div>

  </body>
</html>
