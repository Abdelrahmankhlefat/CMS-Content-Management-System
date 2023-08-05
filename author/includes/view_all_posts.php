<?php
E_ALL ^ E_WARNING;

include("delete_modal.php");
    if(isset($_POST['checkBoxArray'])){

        foreach($_POST['checkBoxArray'] as $postId){
               $bulk_options=  $_POST['bulk_options']; 
               switch($bulk_options){
                case 'published': 
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$postId}'";
                
                $update_to_published_status = mysqli_query($connection, $query); 
                break; 
                
                case 'draft' : 
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id ='{$postId}'"; 
                $update_to_draft_status = mysqli_query($connection, $query); 
                break; 

                case 'delete': 
                $query = "DELETE  FROM posts WHERE post_id = '{$postId}'"; 
                $delete_post = mysqli_query($connection, $query);
                break;

                case 'clone' : 
                    $query = "SELECT * FROM posts WHERE post_id = '{$postId}'"; 
                    $select_posts = mysqli_query($connection, $query); 
                               while($row = mysqli_fetch_assoc($select_posts)){
                       $post_id = $row['post_id'];     
                       $post_title = $row['post_title'];  
                       $post_author = $row['post_author'];  
                       $post_category_id = $row['post_category_id'];  
                       $post_date = $row['post_date']; 
                       $post_image = $row['post_image'];  
                       $post_status = $row['post_status'];  
                       $comments_count = $row['post_comments_counter'];  
                       $post_tags = $row['post_tags'];  
                       $post_content = $row['post_content'];
                       
               } 

               $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_tags,post_comments_counter,post_status,post_content)"; 

               $query .="VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_tags}','{$comments_count}','{$post_status}','{$post_content}')";
           
           
               $copy_query = mysqli_query($connection, $query);
        
                if(!$copy_query){
                    die("QUERY FAILED " .  mysqli_error($connection)); 
                }
            break; 
     }
    }
    }

?>


<form method="post" >
  <table class="table table-bordered table-hover" ">
    <div id="bulkOptionsContainer" class="col-xs-4">
        <select name="bulk_options" id="" class="form-control">
          <option value="" > Select Options </option>
          <option value="published" > Publish </option>
          <option value="draft" > Draft </option>
          <option value="clone" > Clone </option>
          <option value="delete" > Delete </option>
        </select>
</br>

    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add new</a>
    </div>


    
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                                        <th>ID</th>
                                        <th>Author</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Tags</th>
                                        <th>Comments</th>
                                        <th>Date</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Views</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                <?php 
                                        $post_author = $_SESSION['firstname'] ." ". $_SESSION['lastname'];
                                        $query = "SELECT * FROM posts WHERE post_author = '$post_author'"; 
                                        $select_posts = mysqli_query($connection, $query);
                                               while($row = mysqli_fetch_assoc($select_posts)){
                                       $post_id = $row['post_id'];     
                                       $post_title = $row['post_title'];  
                                       $post_author = $row['post_author'];  
                                       $post_category_id = $row['post_category_id'];  
                                       $post_date = $row['post_date']; 
                                       $post_image = $row['post_image'];  
                                       $post_status = $row['post_status'];  
                                       $comments_count = $row['post_comments_counter'];  
                                       $post_tags = $row['post_tags'];  
                                       $post_views = $row['post_views_count'];
                                                   


                                       
                                        
                                          echo "<tr>"; 
                                          ?>

                                              <td><input type="checkbox" name="checkBoxArray[]" class="checkBoxes" id="checkBoxes" value='<?php echo $post_id ?>'></td>

                                            <?php
                                                echo "<td>{$post_id} </td>";
                                                echo "<td>{$post_author} </td>";
                                                echo "<td>{$post_title}</td>";

                                               $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}"; 
                                                $select_categories = mysqli_query($connection, $query); 
                                                        while($row = mysqli_fetch_assoc($select_categories)){
                                                $cat_id = $row['cat_id'];     

                                                $cat_title = $row['cat_title'];  

                                                   echo "<td>{$cat_title} </td>";
                                               }


                                                
                                               echo "<td class='text-center'>"?> <p class="badge text-center" style="<?php echo findClass($post_status) ?>"> <?php echo "{$post_status} </p> </td>";
                                               echo "<td><img width='100px;' src='../images/{$post_image}'> </td>";
                                                echo "<td>{$post_tags} </td>";

                                                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                                                $select_comments_count =  mysqli_query($connection, $query); 
                                                $comments_count  = mysqli_num_rows($select_comments_count); 

                                            
                                            
                                            

                                                echo "<td>{$comments_count} </td>";
                                                echo "<td>{$post_date} </td>";
                                                echo "<td><a class='btn btn-info' href='../post.php?p_id={$post_id}'>View post</a></td>";
                                                echo "<td><a class='btn btn-primary' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</td>";
                                                echo "<td><a class='btn btn-danger delete_link' href='' data-toggle='modal' data-target='#myModal' rel='$post_id'>Delete</a></td>";
                                              //  echo "<td><a onClick=\"javascript :return confirm('Are you sure you want to delete ?'); \" href='posts.php?delete={$post_id}'>Delete</td>";
                                                echo "<td><a href='posts.php?reset={$post_id}'>$post_views</td>";
                                               

                                                
                                          echo "</tr>";

                                               } 
                                               

                                    ?>      
                                 
     



                                </tbody>
                            </table>
                                            </form>

                            <?php 
                                        if(isset($_GET['delete'])){
                                                $the_post_id = $_GET['delete']; 
                                                $query = "DELETE FROM posts WHERE post_id = {$the_post_id}"; 
                                                $delete_query = mysqli_query($connection,$query);
                                        header("Location:posts.php");
                                        }

                                        if(isset($_GET['reset'])){
                                            $the_post_id = $_GET['reset']; 
                                            $query = "UPDATE posts SET post_views_count =0  WHERE post_id = {$the_post_id}"; 
                                            $reset_views = mysqli_query($connection,$query);
                                       header("Location:posts.php");
                                        }      
                            ?>

<script>
    
$("document").ready(function(){

     $(".delete_link").on("click", function(){
         
        var id = $(this).attr("rel"); 
        var delete_url = "posts.php?delete=" +id + " "; 

        $(".modal_delete_link").attr("href", delete_url); 

      



        
     })
})



</script>