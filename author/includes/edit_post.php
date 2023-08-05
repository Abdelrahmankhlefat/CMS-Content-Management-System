<?php 

if(isset($_GET['p_id'])){
    $the_post_id = $_GET['p_id']; 
}

$query = "SELECT * FROM posts WHERE post_id = $the_post_id"; 
$select_posts_by_id = mysqli_query($connection, $query); 
           while($row = mysqli_fetch_assoc($select_posts_by_id)){
   $post_id = $row['post_id'];     
   $post_title = $row['post_title'];  
   $post_category_id = $row['post_category_id'];  
   $post_date = $row['post_date']; 
   $post_image = $row['post_image'];  
   $post_status = $row['post_status'];  
   $post_comments_counter = $row['post_comments_counter'];  
   $post_tags = $row['post_tags'];  
   $post_content = $row['post_content'];
 


  

   

?>
<h3 class="text-center alert alert-warning" > Edit a Post </h3>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
         <input type="text" value="<?php echo $post_title ?>" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <select name="post_category" class="btn btn-success"  id="" value="">
            
     
        

            <?php 
                $query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}'" ; 
                $select_categories = mysqli_query($connection, $query); 

                $row = mysqli_fetch_assoc($select_categories);
                    $cat_id = $row['cat_id'];     

                    $cat_title = $row['cat_title']; 
                echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                
                $query = "SELECT * FROM categories" ; 
                $select_categories = mysqli_query($connection, $query); 
                    while($row = mysqli_fetch_assoc($select_categories)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title']; 

                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }

          } 
                        
                  
                    
                        
                        

            ?>
        
        
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_author">Post Author</label>
         <input type="text" value="" class="form-control" name="post_author">
    </div> -->

    <div class="form-group">
        <select name="post_status" id="" class="btn btn-success" >

        <option value='<?php echo $post_status ?>'><?php echo $post_status ?></option>
            <?php
                if($post_status == 'published'){
                    echo "<option value='draft'  >Draft</option>"; 

                } else{
                    echo "<option value='published'>Published</option>";
                }
            ?>
    </select>
    </div>

    <div class="form-group">
    <img style="width:100px;" src="../images/<?php echo $post_image; ?>">
        
         <input type="file" class="form-control" name="image" value="<?php echo $post_image; ?>">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
         <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
         <textarea value="" name="post_content" id="myTextarea" cols="30" rows="10" class="form-control"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update post">
    </div>


</form>

<?php 
                        
    if(isset($_POST['update_post'])){

        

   $post_title = $_POST['post_title'];  
   $post_image = $_FILES['image']['name'];  
   $post_image_temp = $_FILES['image']['tmp_name'];
   $post_category_id = $_POST['post_category'];
   $post_status = $_POST['post_status'];  
   $post_tags = $_POST['post_tags'];  
   $post_content = $_POST['post_content'];
   move_uploaded_file($post_image_temp, "../images/$post_image"); 

   if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id"; 
        $select_image = mysqli_query($connection,$query); 

        while($row = mysqli_fetch_array($select_image)){
            $post_image = $row['post_image'];
        }
   }

   $query = "UPDATE posts SET "; 
   $query .="post_title = '{$post_title}',"; 
   $query .="post_category_id = '{$post_category_id}',"; 
   $query .="post_date = '{$post_date}' ,"; 
   $query .="post_image = '{$post_image}',"; 
   $query .="post_status = '{$post_status}',"; 
   $query .="post_comments_counter = '{$post_comments_counter}',"; 
   $query .="post_tags = '{$post_tags}',"; 
   $query .="post_content = '{$post_content}'"; 
   $query.= "WHERE post_id = '{$the_post_id}'";

   $update_post = mysqli_query($connection,$query); 

   
   header("Location:posts.php");
    }

    
    

?>