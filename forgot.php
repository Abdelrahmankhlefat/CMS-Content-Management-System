<?php 
use PHPMailer\PHPMailer\PHPMailer; 


global $connection; 
      include "./admin/functions.php";  
      include "./includes/header.php";
      include "./includes/navigation.php";
    //  require './vendor/phpmailer/phpmailer'
     


 
 
    ?>


    <?php

        if(!$_GET['forgot']){
            header("Location: index.php");


        }

   
    ?>


<!DOCTYPE html>
<html lang="en">
  <head>
   <link rel="stylesheet" href="./admin/css/styles.css">
  </head>
    <body class="login_body">
        <div class="wrapper">

            <form id="login_form"  method="post">
                <div class="form_page">
                    <img style="width:35%;" class="avatar" src="./images/forgot.png" alt="">
                <h1>Forgot Password</h1>

                <div class="form_input">
                <label>Email</label>
                    <input type="email" class="input_handler" name="email" autocomplete= "on" required placeholder="enter your email here">
                    

                </div>

               

                <div class="form_input">
                    <input type="submit" class="input_submit" name="forgot_submit">
                </div>
                <?php

                    require './vendor/autoload.php'; 
                    require './classes/config.php';
                    require './vendor/phpmailer/phpmailer/src/Exception.php';
                    require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
                    require './vendor/phpmailer/phpmailer/src/SMTP.php';
                    
                   
            

                        
                    if(isset($_POST['forgot_submit'])){
                        
                        $email = $_POST['email']; 
                        $length = 50;   
                        $token = bin2hex(openssl_random_pseudo_bytes($length)); 

                        if(email_exsists($email)){
                           
                          $stmt =  mysqli_prepare($connection, "UPDATE users SET token= '{$token}' WHERE user_email = ?");
                           mysqli_stmt_bind_param($stmt, "s", $email); 
                           mysqli_stmt_execute($stmt); 

                           mysqli_stmt_close($stmt); 


                      // configure php mailer 
                      $mail = new PHPMailer(); 

                    //Server settings
                   

                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'af49e89ce299bd';                     //SMTP username
                    $mail->Password   = '1b1c47e133dae2';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           //Enable implicit TLS encryption
                    $mail->Port       =  2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8'; 

                    $mail->setFrom("abedalrahmankhlefat@gmail.com", "abood"); 
                    $mail->addAddress($email); 
                    $mail->Subject = "Password reset"; 
                    $mail->Body = "<p> please click to reset the password</p>
                    <a href='http://localhost/CMS_TEMPLATE/reset.php?email=' .$email. '&token=' .$token . '>' "; 
                    
                    if($mail->send()){
                        echo "<h3 class='alert alert-success'> Check your Email to reset the password </h3>";
                    }else{
                        echo "<h3 class='alert alert-danger'> Sending Failed </h3>" . $mail->ErrorInfo;
                    }

                  }else{
                    echo "<h3 class='alert alert-danger'>Email is not registered</h3>";
                  }
                }
               ?>
                </div>
          
            </form>    
        </div>
    </body>
    <?php 
include "includes/footer.php";

?>
</html>


