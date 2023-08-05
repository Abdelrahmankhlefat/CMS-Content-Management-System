
 <?php  include "includes/header.php"; 
        include "./admin/functions.php";
 ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">


    <?php 
    E_ALL ^ E_WARNING;

        if(isset($_POST['submit'])){

       $fname = trim($_POST['firstname']);
       $lname = trim($_POST['lastname']);
       $username = trim($_POST['username']);
       $email = trim($_POST['email']);
       $password = trim($_POST['password']);
       $confirm = trim($_POST['confirmation']);

       $empty =   check_empty($username, $email, $password, $confirm);
       $confirmation = confirmPassword($password,$confirm); 
       $email_exsists = email_exsists($email); 
       $user_exists = username_exists($username);
    
    
       $errors = $empty .$confirmation .$email_exsists .$user_exists;
    
    
           if($errors == '' ){
        $username = mysqli_real_escape_string($connection,$username); 
        $email = mysqli_real_escape_string($connection,$email);
        $password = mysqli_real_escape_string($connection,$password);
        
        
    
    // password ecryption 
    $encrypted_pass = base64_encode($password);
    // insertion 
    $query = "INSERT INTO users (username, user_email, user_password,user_firstname, user_lastname, user_role)"; 
    $query .= "VALUES('{$username}','{$email}','{$encrypted_pass}','{$fname}','{$lname}','subscriber')"; 
    $register_user_query = mysqli_query($connection,$query); 
    if(!$register_user_query){
       die("Query Failed : ". mysqli_error($connection)); 
      mysqli_errno($connection);
    };
    }
}
?>
    
<section id="signUp">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Registeration</h1>
    </br>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h5 class="text-danger" style="text-align:center; "><?php if(isset($_POST['submit'])) echo $empty ."<br>".$user_exists."<br>". $confirmation ."<br>". $email_exsists;   ?></h5>

                      <div style="display:flex; flex-direction:row; justify-content: space-evenly">
                        <div class="form-group col-md-6">
                            <label for="username" class="">First name</label>
                            <input  type="text" name="firstname" id="firstname" class="form-control " required placeholder="First name " autocomplete="on" value="<?php $p = $_POST; echo isset($p['firstname']) ? $p['firstname'] : '';?>">
                            <p><?php    ?></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname" class="">Last name</label>
                            <input  type="text" name="lastname" id="lastname" class="form-control" required placeholder="Last name" autocomplete="on" value="<?php echo isset($p['lastname']) ? $p['lastname'] : '';?>">
                            <p><?php    ?></p>
                        </div>
                      
                      </div>
                      <div style="display:flex; flex-direction:row; justify-content: space-between">
                      <div class="form-group col-md-6">
                            <label for="lastname" class="">Username</label>
                            <input  type="text" name="username" id="username" class="form-control" required placeholder="Pick a username" autocomplete="on" value="<?php echo isset($p['username']) ? $p['username'] : '';?>">
                            <p><?php    ?></p>
                        </div>
                         <div class="form-group col-md-6">
                            <label for="email" class="">Email</label>
                            <input  type="email" name="email" id="email" class="form-control" required placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($p['email']) ? $p['email'] : '';?>">
                        </div>
                     </div>

                     
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input  type="password" name="password" id="key" class="form-control " required placeholder="Password" autocomplete="off">
                         </div>
                    
                        <div class="form-group">
                            <label for="confirmation" class="sr-only">Password Confirmation</label>
                            <input type="password" name="confirmation" id="key" class="form-control" required placeholder="Confirm your Password" autocomplete="off">
                        </div>
                  
                
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Create account">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
