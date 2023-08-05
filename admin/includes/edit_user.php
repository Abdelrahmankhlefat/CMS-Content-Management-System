<?php 




if(isset($_GET['edit_user'])){
    $user_id = $_GET['edit_user']; 
}

$query = "SELECT * FROM users WHERE `user_id` = $user_id"; 
$select_user_by_id = mysqli_query($connection, $query); 
           while($row = mysqli_fetch_assoc($select_user_by_id)){
   $user_firstname = $row['user_firstname'];     
   $user_lastname = $row['user_lastname'];  
   $user_role = $row['user_role'];  
   $username = $row['username'];  
   $user_email = $row['user_email']; 
   $user_password = $row['user_password'];  


}



?>
<h3 class="text-center alert alert-warning"> Edit a User </h3>
<form action="" method="post" enctype="multipart/form-data" >

    <div class="form-group">
        <label for="user_firstname">First name </label>
         <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last name </label>
         <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
    </div>
   
  

    <div class="form-group">
        <select class="btn btn-primary" name="user_role" id="">
            
            <?php 

                $query = "SELECT * FROM users WHERE `user_id` = $user_id"; 
                $select_users = mysqli_query($connection, $query); 
                        while($row = mysqli_fetch_assoc($select_users)){
                $user_id = $row['user_id'];     
                $user_role = $row['user_role'];  
                
                echo "<option>{$user_role}</option>";
          




                                }
        if ($user_role=="admin"){
        echo  "<option value='subscriber'>Subscriber</option> "  ;  
        echo  "<option value='author'>Author</option> "  ;  

        }else if($user_role=="subscriber"){
            echo  "<option value='admin'>Admin</option> "  ;    
            echo  "<option value='author'>Author</option> "  ;  

        }else if($user_role == "author"){
            echo  "<option value='subscriber'>subscriber</option> "  ;    
            echo  "<option value='admin'>admin</option> "  ;    

        }
                    ?>




            </select>
    </div>






<!--
    <div class="form-group">
        <label for="image">Post Image</label>
         <input type="file" class="form-control" name="image">
    </div>

                    -->

    <div class="form-group">
        <label for="username">Username</label>
         <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
         <input type="text" class="form-control" name="user_email" value="<?php echo $user_email ?>">
    </div>

    <div class="form-group">
        <label for="user_email">Password</label>
         <input autocomplete="off" type="password" class="form-control" name="user_password" value="">
    </div>

   



    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>


</form>



<?php 
                        
    if(isset($_POST['edit_user'])){

        

   $user_firstname = $_POST['user_firstname'];  
   $user_lastname = $_POST['user_lastname'];  
   $user_role = $_POST['user_role'];
   $username = $_POST['username'];
   $user_email = $_POST['user_email'];
   $user_password= $_POST['user_password']; 

   $hashed_pass = base64_encode($user_password); 

  
   $query = "UPDATE users SET "; 
   $query .="user_password = '{$hashed_pass}',"; 
   $query .="user_firstname = '{$user_firstname}',"; 
   $query .="user_lastname = '{$user_lastname}',"; 
   $query .="user_role = '{$user_role}',"; 
   $query .="username = '{$username}',"; 
   $query .="user_email = '{$user_email}'"; 
   $query.= "WHERE user_id = '{$user_id}'";

   
   $edit_user = mysqli_query($connection,$query); 


   header("Location:users.php");
    
    
    }
    
    

?>