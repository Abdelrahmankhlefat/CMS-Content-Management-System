<?php   global $connection; 
E_ALL ^ E_WARNING;
      include "./admin/functions.php";  
      include "./includes/navigation.php";

session_start();
if(!empty($_SESSION['username'])) {
    header("Location:index.php" );
}else{ 
        
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
            }   


$password = base64_encode($password);

if($username === $db_username && $password === $db_user_password){
    $_SESSION['username'] = $db_username; 
    $_SESSION['firstname']= $db_user_firstname; 
    $_SESSION['lastname'] = $db_user_lastname; 
    $_SESSION['user_role'] = $db_user_role; 

  
   

      header("Location:../admin");
  
}else { 
  header("Location:../index.php"); 
 
  
}

}
}

    ?>


<!DOCTYPE html>
<html lang="en">
  <head>
   <link rel="stylesheet" href="./admin/css/styles.css">
  </head>
    <body class="login_body">
        <div class="wrapper">
     <?php   if($_SESSION['username'] == ''){
         echo '
            <form id="login_form" action="./includes/login.php" method="post">
                <div class="form_page">
                    <img class="avatar" src="./images/avatar.png" alt="">
                <h1>Log in</h1>

                <div class="form_input">
                <label>Username</label>
                    <input type="text" class="input_handler" name="username" autocomplete= "on" required placeholder="enter Username here">
                    

                </div>

                <div class="form_input">
                <label>Password</label>
                    <input type="password" class="input_handler" name="password" placeholder="enter your Password">
                    <a style="float:left;" href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot your password ?</a>
                   
                </div>

                <div class="form_input">
                    <input type="submit" class="input_submit" name="login">
                </div>
                <a href="registration.php">Register here </a>
                </div>
            </form>  '; }else{

echo '
                <div class="form_page">
                <img class="avatar" src="./images/avatar.png" alt="">
                <h1> Logged in as : '. $_SESSION['username'] . '</h1>

           
            
                <a href="./includes/logout.php"><button class="btn btn-primary"  name="logout" value="logout">Logout</button> </a>
            </div>

';


            }
            ?>
         </div>
    </body>
    
    <?php 
include "includes/footer.php";

?>
</html>


