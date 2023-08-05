<?php   global $connection; 
      include "../admin/functions.php";  
      include "./includes/header.php";
      include "./navigation.php";

    session_start();
        
if(isset($_POST['login'])){

    $username = $_POST['username']; 
    $password = $_POST['password']; 

    $username = trim($username); 
    $password = trim($password); 


    $username = mysqli_real_escape_string($connection, $username); 
    $password = mysqli_real_escape_string($connection, $password); 

        global $connection;
        $query = "SELECT * FROM users WHERE username ='${username}'"; 
        $select_user_query = mysqli_query($connection, $query); 
            if(!$select_user_query){
                die("QUERY FAILED". mysqli_error($connection));

            }

            while($row = mysqli_fetch_array($select_user_query)) {
                $db_user_id = $row['user_id'];
                $db_username = $row['username'];
                $db_user_firstname = $row['user_firstname'];
                $db_user_lastname = $row['user_lastname'];
                $db_user_role = $row['user_role'];
                $db_user_password = $row['user_password']; 
                $db_user_email = $row['user_email'];
            }   


$password = base64_encode($password);

if($username === $db_username && $password === $db_user_password){
    $_SESSION['username'] = $db_username; 
    $_SESSION['firstname']= $db_user_firstname; 
    $_SESSION['lastname'] = $db_user_lastname; 
    $_SESSION['user_role'] = $db_user_role; 
    $_SESSION['user_id']= $db_user_id;
    $_SESSION['user_email'] = $db_user_email;

  
   

      header("Location:../admin");
  
}else { 
  header("Location:../index.php"); 
 
  
}

}

    ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-quiv="X-UA-Compatible" content="IE=edge"/>
        <link rel="stylesheet" href="../admin/css/styles.css">
        <title>siZZLe | coders club </title>
    </head>
    <body>
        <div class="wrapper">

            <form id="login_form" action="login.php" method="post">
                <div class="form_page">
                <h1>Log in</h1>

                <div class="form_input">
                    <input type="text" class="input_handler" name="username" autocomplete= "on" required placeholder="Username">
                    <label>Username</label>

                </div>

                <div class="form_input">
                    <input type="password" class="input_handler" name="password" placeholder="Password">
                    <label>Password</label>
                </div>

                <div class="form_input">
                    <input type="submit" class="input_submit" name="submit">
                </div>
                <a href="register.php">Register here </a>
                </div>
            </form>    
        </div>
    </body>
</html>


<?php 
include "footer.php";

?>