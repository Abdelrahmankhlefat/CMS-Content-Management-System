<?php 
    include "./includes/header.php";
    include "./admin/functions.php";
    include "./includes/db.php";
?>









<!DOCTYPE html>
<html lang="en">
  <head>
   <link rel="stylesheet" href="./admin/css/styles.css">
  </head>
    <body class="login_body">
        <div class="wrapper">

        <?php 

    $email = 'abood.yasin@yahoo.com';
    


    if($stmt = mysqli_prepare($connection, 'SELECT username , user_email , token FROM users WHERE token=?'))
        mysqli_stmt_bind_param($stmt,"s", $token);  
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_bind_result($stmt, $username, $user_email, $_GET['token']);
        mysqli_stmt_fetch($stmt); 
        mysqli_stmt_close($stmt); 

       /* if($_GET['token'] !== $token || $_GET['email'] !== $email){

            header("Location: index.php");
        }*/

        if(isset($_POST['password']) && isset($_POST['cpassword'])){
           if($_POST['password'] === $_POST['cpassword']){
               echo "they are the same "; 
               $password = $_POST['password']; 
               $encrypted_pass = base64_encode($password);

               if($stmt = mysqli_prepare($connection, "UPDATE users SET token='' ,user_password='{$encrypted_pass}' WHERE user_email =?")){
                    mysqli_stmt_bind_param($stmt, "s", $_GET['email']); 
                    mysqli_stmt_execute($stmt); 

                    if(mysqli_stmt_affected_rows($stmt) >= 1 ){
                        header("Location: login1.php");

                    }

                    mysqli_stmt_close($stmt); 
                    $verified = true; 
                }
           }else{
               echo "<h1 class='alert alert-danger'>they are not the same </h1>"; 

           }
            
        }



        ?>

            <form id="login_form"  method="post">
           
                <div class="form_page">
                
                    <img style="width:35%;" class="avatar" src="./images/forgot.png" alt="">
                <h1>Reset Password</h1>

                <div class="form_input">
                <label>Password</label>
                    <input type="password" class="input_handler" name="password" autocomplete= "off" required placeholder="enter the new password here">
                </div>

                <div class="form_input">
                <label> Confirm Password</label>
                    <input type="password" class="input_handler" name="cpassword" autocomplete= "off" required placeholder="confirm your password here">
                </div>

                    <div class="form_input">
                    <input type="submit" class="input_submit" name="reset_submit">
                </div>
            
                </div>

             
               


                </div>
          
            </form>    
        </div>
    </body>
    <?php 
include "includes/footer.php";

?>
</html>
