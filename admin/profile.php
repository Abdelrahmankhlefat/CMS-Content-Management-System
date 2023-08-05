<?php include "./includes/Aheader.php"; ?> 

<?php

if(isset($_SESSION['username'])){

    $username = $_SESSION['username']; 
$query = "SELECT * FROM users WHERE username = '{$username}' "; 
$select_user_profile = mysqli_query($connection,$query); 

while($row = mysqli_fetch_array($select_user_profile)){
         $user_id = $row['user_id'];     
         $username = $row['username'];  
         $user_password = $row['user_password'];
         $user_firstname = $row['user_firstname'];  
         $user_lastname = $row['user_lastname'];  
         $user_email = $row['user_email']; 
         $user_image = $row['user_image']; 
         $user_role = $row['user_role'];  
                                        
}
}

?> 
   <?php 
   
   if(isset($_POST['edit_user'])){

        

    $user_firstname = $_POST['user_firstname'];  
    $user_lastname = $_POST['user_lastname'];  
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
   
    $query = "UPDATE users SET "; 
    $query .="user_firstname = '{$user_firstname}',"; 
    $query .="user_lastname = '{$user_lastname}',"; 
    $query .="user_role = '{$user_role}',"; 
    $query .="username = '{$username}',"; 
    $query .="user_email = '{$user_email}'"; 
    $query.= "WHERE username = '{$username}'";
 
    
    $edit_user = mysqli_query($connection,$query); 
 
   
    header("Location:profile.php");
     
     
     }
     
     
 
 ?>
   
   
   
   
   ?>

    <div id="wrapper">


    <!-- navigation -->

        <?php include "./includes/Anavigation.php";
        
        ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Welcome to Admin 
                            <small>My profile</small>
                        </h1>

                        <h2 class="alert alert-warning text-center" > Edit my Info </h2>
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
    <select class="btn btn-warning" name="user_role" id="">
        
        <?php 

            $query = "SELECT * FROM users WHERE `user_id` = $user_id"; 
            $select_users = mysqli_query($connection, $query); 
                    while($row = mysqli_fetch_assoc($select_users)){
            $user_id = $row['user_id'];     
            $user_role = $row['user_role'];  
            
            echo "<option>{$user_role}</option>";
      




                            }
    if ($user_role=="admin"){
    echo  "<option value='subscriber'>subscriber</option> "  ;    

    }else if($user_role=="subscriber"){
        echo  "<option value='admin'>admin</option> "  ;    

    }else{
        echo  "<option value='subscriber'>subscriber</option> "  ;    
        echo  "<option value='admin'>admin</option> "  ;    

    }
                ?>




        </select>
</div>


<div class="form-group">
    <label for="username">Username</label>
     <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
</div>

<div class="form-group">
    <label for="user_email">Email</label>
     <input type="text" class="form-control" name="user_email" value="<?php echo $user_email ?>">
</div>





<div class="form-group">
    <input type="submit" class="btn btn-primary" name="edit_user" value="Update profile">
</div>


</form>












                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "./includes/Afooter.php"; ?>