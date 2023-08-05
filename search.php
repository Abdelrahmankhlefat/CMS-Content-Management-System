
<?php 

 include "./includes/header.php";
 
 include "./includes/navigation.php";
   
 


if(isset($_POST['submit'])){
    $search = $_POST['search']; 

   
    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published'"; 
    $search_query = mysqli_query($connection, $query); 
    
    if(!$search_query) { 
        die("QUERY FAILED" . mysqli_error($connection)); 

    }

    $count = mysqli_num_rows($search_query); 
     if($count == 0){
          echo "<h1 style='color:red;'> No result </h1>";
     }
     else { ?>
     <div class="container">

<div class="row">
 
        <div class="col-md-8">
       <?php
        while($row = mysqli_fetch_assoc($search_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];     
            $post_content = $row['post_content'];
            
        ?>
        
        
        <h1 class="page-header">
         <h1> Search for courses </h1>
         <span>   <h6>Courses page</h6> </span>
                        </h1>
        
        
        
                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                        <hr>
                        <a href="post.php?p_id=<?php echo $post_id ?>"><img class="img-responsive" src="./images/<?php echo $post_image ?>" alt=""></a>                <hr>
                        <hr>
                        <p><?php echo $post_content = substr($row['post_content'],0,100) . " ..."; ?></p>
                        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
                        <hr>
        
        
        <?php
        }
        
                
     
                
        }
        
             

             
        }
        ?>
             

             </div>

<!-- Blog Sidebar Widgets Column -->
<?php include "./includes/sidebar.php" ?>

</div>
<!-- /.row -->


<?php 
include "./includes/footer.php"; 

?>


