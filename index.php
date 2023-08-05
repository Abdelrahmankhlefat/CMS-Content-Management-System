
<?php 
include "./includes/header.php";
?>

    <!-- Navigation -->
  <?php 
include "./includes/navigation.php";
  ?>

  
    <!-- Page Content -->
 ]  
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                     
                    <small>Posts Wall</small>
                </h1>
                <?php

$per_page = 5; 
    if(isset($_GET['page'])){
      



       $page =  $_GET['page'];

    }else{ 
        $page = ""; 

    }

    if($page == "" || $page ==1) { 
        $page_1 = 0; 

    }else{ 
        $page_1 = ($page * $per_page) - $per_page; 
    }





$query_count = "SELECT * FROM posts "; 
$find_count = mysqli_query($connection, $query_count); 
$count = mysqli_num_rows($find_count);
$count =  ceil($count / $per_page) ; 

    






$query = "SELECT * FROM posts WHERE post_status ='published' ORDER BY post_views_count DESC LIMIT $page_1,$per_page"; 
$select_all_posts_query = mysqli_query($connection, $query); 
    
while($row = mysqli_fetch_assoc($select_all_posts_query)){
    
    $post_id= $row['post_id']; 
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];     
    $post_content = $row['post_content'];
    $post_category = $row['post_category_id'];
    


                    $query = "SELECT * FROM categories WHERE cat_id  = '{$post_category}'"; 
                    $find_cats = mysqli_query($connection,$query); 
                    while($row = mysqli_fetch_assoc($find_cats)){
                        $post_category_title = $row['cat_title'];
                    }
                     
                     
                     ?>




                <!-- First Blog Post -->
                
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ." " ?></a><small><?php echo $post_category_title ?></small>
                </h2>
                <p class="lead">
                    by <a href="#"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>"><img class="img-responsive" src="./images/<?php echo $post_image ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content = substr($post_content,0,100). " ..."; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


<?php
}
?>




                

                

               
              


            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "./includes/sidebar.php" ?>

        </div>
        <!-- /.row -->


        <hr> 
        <ul class="pager">
            <?php 
                for($i=1; $i<=$count; $i++){

                    if($i == $page){
                        echo "<li><a style='background-color:black' href='index.php?page={$i}'>{$i}</a></li>";

                    }else{
                    echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                    }
                }
            
            
            
            ?>
           


        </ul>

        
<?php 
include "./includes/footer.php"; 

?>