
<?php
E_ALL ^ E_WARNING;
    if(isset($_POST['checkBoxArray'])){

        foreach($_POST['checkBoxArray'] as $comId){
               $bulk_options=  $_POST['bulk_options']; 
               switch($bulk_options){
                case 'Approved': 
                $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = '{$comId}'";
                
                $approve_comments = mysqli_query($connection, $query); 
                break; 
                
                case 'Unapproved' : 
                $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE  comment_id = '{$comId}'"; 
                $unapprove_comments = mysqli_query($connection, $query); 
                break; 

                case 'delete': 
                $query = "DELETE  FROM comments WHERE  comment_id = '{$comId}'"; 
                $delete_comments = mysqli_query($connection, $query);
                break;

                
            }
        }
        
    }

?>                            
                            
  
  





                            
                            
<form method="post" >
        <div class="table-responsive">

  <table class="table table-bordered table-hover table-responsive-sm">
    <div id="bulkOptionsContainer" class="col-xs-4">
        <select name="bulk_options" id="" class="form-control">
          <option value="" > Select Options </option>
          <option value="Approved" > Approve </option>
          <option value="Unapproved" > Unapprove </option>
          <option value="delete" > Delete </option>
        </select>
</br>

    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="apply">
       
    </div>

                            
                            
                            
                            
                            
                            
                            
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                                        <th> ID</th>
                                        <th> Author</th>
                                        <th> Comment</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>in response to </th>
                                        <th>Date</th>
                                        <th>Approve</th>
                                        <th>unapprove</th>
                                        <th>delete</th>


                                      
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                <?php 
            
                                    $query = "SELECT * FROM comments"; 
                                    $select_comments = mysqli_query($connection, $query); 
                                               while($row = mysqli_fetch_assoc($select_comments)){
                                       $comment_id = $row['comment_id'];     
                                       $comment_post_id = $row['comment_post_id'];  
                                       $comment_date = $row['comment_date'];  
                                       $comment_author = $row['comment_author'];  
                                       $comment_email = $row['comment_email']; 
                                       $comment_content = $row['comment_content'];  
                                       $comment_status = $row['comment_status'];  
                                         
                                                   


                                       
                                        
                                          echo "<tr>"; 

                                        ?>

                                <td><input type="checkbox" name="checkBoxArray[]" class="checkBoxes" value='<?php echo $comment_id ?>'></td>

                                <?php
                                                echo "<td>{$comment_id} </td>";
                                                echo "<td>{$comment_author} </td>";
                                                echo "<td>{$comment_content} </td>";                                           
                                                echo "<td>{$comment_email} </td>";
                                                echo "<td>{$comment_status} </td>";
                                                
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
                                                        
                                                
                                                echo "<td><a href='comments.php?approve= $comment_id'>Approve</td>";     
                                                echo "<td><a href='comments.php?unapprove= $comment_id'>unapprove</td>";                                
                                                echo "<td><a href='comments.php?delete=$comment_id'>Delete</td>";

                                                
                                          echo "</tr>";

                                               } 
                                               

                                    ?>      
                                </tbody>
                            </table>
                                            </div>
                                            </form>

                            <?php 

                                                if(isset($_GET['approve'])){
                                                    $approve_comment_id = $_GET['approve']; 
                                                $query = "UPDATE comments SET comment_status='Approved' WHERE comment_id = $approve_comment_id "; 
                                                $approve_comment_query = mysqli_query($connection,$query);
                                                header("Location:comments.php");


                                                }

                                                if(isset($_GET['unapprove'])){
                                                    $unapprove_comment_id = $_GET['unapprove']; 
                                                $query = "UPDATE comments SET comment_status='Unapproved' WHERE comment_id = $unapprove_comment_id"; 
                                                $unapprove_comment_query = mysqli_query($connection,$query);
                                                header("Location:comments.php");

 
                                               }

                                    if(isset($_GET['delete'])){
                                        $comment_id = $_GET['delete']; 

                                $query = "DELETE FROM comments WHERE comment_id = {$comment_id}"; 
                                $delete_query = mysqli_query($connection,$query);
                                header("Location:comments.php");


                                }


                                ?>

