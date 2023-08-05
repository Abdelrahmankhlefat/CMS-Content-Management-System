<?php 
E_ALL ^ E_WARNING;
global $connection;

    function users_online(){
    global $connection;
    
    $session = session_id(); 
    $time = time(); 
    $time_out_in_seconds = 60; 
    $time_out = $time - $time_out_in_seconds; 

    $query = "SELECT * FROM online_users WHERE session = '$session'"; 
    $send_query = mysqli_query($connection, $query); 
    $count = mysqli_num_rows($send_query); 

    if($count == NULL){
        mysqli_query($connection, "INSERT INTO online_users(session, time)VALUES ('$session','$time')");

    }else{
        mysqli_query($connection, "UPDATE online_users SET time = '$time' WHERE session = '$session'" );

    }
    $users_online_query = mysqli_query($connection, "SELECT * FROM online_users WHERE time >'$time_out' " );
    return $count_user = mysqli_num_rows($users_online_query);

     
}




function check_empty($username, $email, $password, $confirm){
    global $connection; 
    if(empty($username)||
    empty($email) || 
    empty($password)|| 
    empty($confirm)
    ){
       return "Please fill all the fields"; 
    }else{
        return '';
    }
}



function confirmPassword($password, $confirm){
    global $connection; 

    if($password !== $confirm){
        return "password not confirmed"; 
    }else{
        return '';
    }
}

function findCount($table){
    global $connection;
                    $query = "SELECT * FROM $table"; 
                    $select_all = mysqli_query($connection, $query); 
                    $find_count =  mysqli_num_rows($select_all);
                    
                    return $find_count; 
                    
}



function findStats($table,$var,$term){
    global $connection;
    $query = "SELECT * FROM $table WHERE $var = '$term'"; 
    $select_all = mysqli_query($connection, $query); 
    $find_count =  mysqli_num_rows($select_all); 

    return $find_count;
}

function email_exsists($email){
    global $connection; 

    $query = "SELECT user_email FROM users WHERE user_email = '$email'"; 
    $result =   mysqli_query($connection, $query); 

    if(mysqli_num_rows($result) > 0){
        return true; 

    }else{
        return false; 
    }

}

function username_exists($username){
    global $connection; 

    $query = "SELECT username FROM users WHERE username = '$username'"; 
    $result =   mysqli_query($connection, $query); 

    if(mysqli_num_rows($result) > 0){
        return "username exists"; 

    }else{
        return ''; 
    }

}



function redirect($location){
    return header("Location:". $location);
}



function escape($string){
    global $connection; 

    mysqli_real_escape_string($connection, trim($string));
}



function login_user($username, $password){

global $connection;
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

}








function isLoggedIn(){
    global $connection; 

    if(isset($_SESSION['username'])){
        return $_SESSION['username']; 

    }else{
        return "not logged in"; 
    }
}


function findClass($status){
    global $connection;
    if($status == 'published'){
        return "background-color :  #37c437"; 
    }else if($status == 'draft'){
        return "background-color : tomato"; 
    }else{
        return "badge-primary";

    }
}

function findClassUser($role){
    global $connection;
    if($role == 'admin'){ 
        return "background-color : #37c437 "; 
    }else if($role == 'author'){
        return "background-color : orange"; 
    }else{
        return "background-color : tomato"; 

    }
}





function register_user($username, $email, $password){
            
            global $connection; 

            $username = mysqli_real_escape_string($connection,$username); 
            $email = mysqli_real_escape_string($connection,$email);
            $password = mysqli_real_escape_string($connection,$password);

            

            // password ecryption 
            $encrypted_pass = base64_encode($password);
            // insertion 
            $query = "INSERT INTO users (username, user_email, user_password, user_role)"; 
            $query .= "VALUES('{$username}','{$email}','{$encrypted_pass}','subscriber')"; 
            $register_user_query = mysqli_query($connection,$query); 
            if(!$register_user_query){
                die("Query Failed : ". mysqli_error($connection)); 
               mysqli_errno($connection);
             }
        
        
}

function insert_categories(){
    global $connection;
    
    if(isset($_POST['submit'])){
     $cat_title = $_POST['cat_title'];

     if($cat_title == "" || empty($cat_title)) {
         echo "This field should not be empty" ; 
     }else { 
         $query = "INSERT INTO categories(cat_title) ";
         $query .="VALUE('{$cat_title}')"; 
         
         $create_category_query  = mysqli_query($connection,$query); 

         if(!$create_category_query){

          die('QUERY FAILED ' . mysqli_error($connection));
         }else 

         echo " Category inserted successfully";
     }


    }

}


function LoggedIn(){
    global $connection;
    if(isset($_SESSION['username'])){
        return true; 
    }else{
        return false; 
    }
}

function loggedInUserId(){
    global $connection;
echo $_SESSION['user_id']; 
}

function userLiked($post_id =''){
    global $connection;
    $the_post_id = 0;
    $result = mysqli_query($connection, "SELECT * FROM likes WHERE user_id= ".$_SESSION['user_id']. " AND post_id={$the_post_id}");
    $result = mysqli_num_rows($result); 
if($result){
    return true; 
}else{
    return false;
}

}


function findallcats(){
    global $connection;
    // FIND ALL CATEGORIES QUERY 
    $query = "SELECT * FROM categories"; 
    $select_categories = mysqli_query($connection, $query); 
               while($row = mysqli_fetch_assoc($select_categories)){
       $cat_id = $row['cat_id'];     

       $cat_title = $row['cat_title'];  
       echo "<tr>";    
   echo "<td>{$cat_id}</td>";
   echo "<td>{$cat_title}</td>";
   echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
   echo "<td><a href='categories.php?edit={$cat_id}'>EDIT</a></td>";

   echo "</tr>";
}
}

function returnSet($value){
    return isset($value) ? $value : '';
}


function deletecats(){
global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete']; 

    $query ="DELETE FROM categories WHERE cat_id = {$the_cat_id}"; 
     $delete_query = mysqli_query($connection,$query);
     header("Location: categories.php");
    }



}








  ?>
