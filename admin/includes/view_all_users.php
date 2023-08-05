<!--

<style>

.loader{
    display:inline-block; 
    width:500px; 
    height: 20px;
    border-radius: 40px;
    background-color: rgba(255,255,255,1);
    position: relative;
    overflow: hidden;


}

.loader::before{
    content: "";
    position: absolute;
    top:0;
    left: -50px;
    width:150%;
    height: 100%;
    background-image: linear-gradient(332deg,#6b70ff,#f8adff);
    border-radius: inherit;
    transform : scaleX(0); 
    transform-origin: left;
    animation: scale 10 infinite;  

}

@keyframes scale {
    50%{
        transform:scaleX(1);
    }
    100%{
        transform: scaleX(0); 
        transform-origin: right;
    }
}



    </style> -->
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"> ID</th>
                                        <th class="text-center"> username</th>
                                        <th class="text-center"> first name</th>
                                        <th class="text-center">last name</th>
                                        <th class="text-center">email </th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                     


                                      
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                <?php 
            
                                    $query = "SELECT * FROM users"; 
                                    $select_users = mysqli_query($connection, $query); 
                                               while($row = mysqli_fetch_assoc($select_users)){
                                       $user_id = $row['user_id'];     
                                       $username = $row['username'];  
                                       $user_password = $row['user_password'];
                                       $user_firstname = $row['user_firstname'];  
                                       $user_lastname = $row['user_lastname'];  
                                       $user_email = $row['user_email']; 
                                       $user_image = $row['user_image']; 
                                       $user_role = $row['user_role'];  
                                       
                                         
                                                   


                                       
                                        
                                          echo "<tr>"; 
                                                echo "<td>{$user_id} </td>";
                                                echo "<td>{$username} </td>";
                                                echo "<td>{$user_firstname} </td>";                                           
                                                echo "<td>{$user_lastname} </td>";
                                                echo "<td>{$user_email} </td>";
                                                echo "<td class='text-center'>"?> <p class="badge text-center" style="<?php echo findClassUser($user_role) ?>"> <?php echo "{$user_role} </p> </td>";

                                        /*        
                                                $query = "SELECT * FROM posts where post_id = $comment_post_id"; 
                                                $select_post_id_query =mysqli_query($connection,$query); 
                                                    while($row = mysqli_fetch_assoc($select_post_id_query)){

                                                        $post_id = $row['post_id']; 
                                                        $post_title = $row['post_title']; 

                                                        if(empty($post_id)){
                                                            echo "<td> post not found </td>"; 
                                                        }else{ 

                                                        echo "<td><a href='../post.php?p_id=$post_id'> $post_title</a>  </td> ";
                                                        }
                                                    }
                                                echo "<td>{$comment_date}</td>";
                                                        */
                                                
                                            /*    echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</td>";
                                                 echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</td>";*/
                                                echo "<td class='text-center'><a class='btn btn-primary' href='users.php?source=edit_user&edit_user=$user_id'>Edit</td>";                                
                                                echo "<td class='text-center'><a class='btn btn-danger' href='users.php?delete= $user_id'>Delete</td>";

                                                
                                          echo "</tr>";

                                               } 
                                               

                                    ?>      
                                </tbody>
                            </table>


                            <?php 

                                       
                                               
                                    if(isset($_GET['delete'])){


                                        if(isset($_SESSION['user_role'])){

                                            if( $_SESSION['user_role'] == 'admin'){


                                        $user_id = $_GET['delete']; 

                                $query = "DELETE FROM users WHERE `user_id` = {$user_id}"; 
                                $delete_query = mysqli_query($connection,$query);
                                header("Location:users.php");

                                    }
                                }

                            }
                                
                                if(isset($_GET['change_to_admin'])){
                                    $user_id = $_GET['change_to_admin']; 

                            $query = "Update users set user_role = 'admin'  WHERE `user_id` = {$user_id}"; 
                            $admin_query = mysqli_query($connection,$query);
                            header("Location:users.php");

                                }

                            if(isset($_GET['change_to_sub'])){
                                $user_id = $_GET['change_to_sub']; 

                        $query = "Update users set user_role = 'subscriber'  WHERE `user_id` = {$user_id}"; 
                        $sub_query = mysqli_query($connection,$query);
                        header("Location:users.php");







                                }


            


                                ?>