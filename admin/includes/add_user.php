<?php 
if(isset($_POST['create_user'])){
     
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['password'];
    
   




    $query = "INSERT INTO users(user_firstname,user_lastname,user_role,username,user_email,user_password)"; 

    $query .="VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}')";


    $create_user_query = mysqli_query($connection, $query);

    

    echo "User Created: " . " " . "<a href='users.php' class='btn'>View Users</a>";



}



?>
<h3 class="alert alert-success text-center"> Add a New User </h3>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname">First name </label>
         <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last name </label>
         <input type="text" class="form-control" name="user_lastname">
    </div>
   
  

    <div class="form-group">
        <select name="user_role" id="" class="btn btn-primary">
           
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
            <option value="author">Author</option> 

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
         <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
         <input type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
         <input type="password" class="form-control" name="password">
    </div>



    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>


</form>