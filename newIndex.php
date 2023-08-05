   <!-- Navigation -->
  <?php 
include "./includes/navigation.php";
 
 // pagination start 
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

$query_count = "SELECT * FROM posts ORDER BY post_views_count DESC"; 
$find_count = mysqli_query($connection, $query_count); 
$count = mysqli_num_rows($find_count);
$count =  ceil($count / $per_page) ; 

// pagination end 
?>
<div class="container" >
    <div class="col-lg-12" >
        <div class="row" style="display:flex; justify-content:flex-start; flex-flow:row wrap; margin: 0 1em;  ">

<?php
$query = "SELECT * FROM posts WHERE post_status ='published'"; 
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

               
<div class="card" style="width: 30rem; margin:1em 2em 4em; height:320px; position:relative; ">
  
  <a href="post.php?p_id=<?php echo $post_id ?>"><img class="card-img-top" style="height:12em; width:22em" src="./images/<?php echo $post_image ?>" alt=""></a>
  <div class="card-body">
  <p style="margin: 1em 0 "><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
    <h4 class="card-title"><?php echo $post_title ?></h4>
    <!-- <h5 class="card-text" style="line-height:1.5em;"><?php echo $post_content = substr($post_content,0,100). " ..."; ?></h5> -->
    <small><?php echo $post_category_title ?></small><br>
    <a href="post.php?p_id=<?php echo $post_id ?> " class="btn btn-primary" style="position:absolute; bottom:0;">Read more</a>
  
  </div>
</div>

                
      
<?php
}
?>

   <!--
<h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ." " ?></a><small><?php echo $post_category_title ?></small>
                </h2>
                <p class="lead">
                    by <a href="#"><?php echo $post_author ?></a>
                </p>
               
                <hr>
                
                <hr>
                <p><?php echo $post_content = substr($post_content,0,100). " ..."; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>


-->

                

               
              

</div>
</div>

        </div>
        <hr> 
        <ul class="pager">
            <?php /*
                for($i=1; $i<=$count; $i++){

                    if($i == $page){
                        echo "<li><a style='background-color:black' href='index.php?page={$i}'>{$i}</a></li>";

                    }else{
                    echo "<li><a href='newIndex.php?page={$i}'>{$i}</a></li>";
                    }
                }
            
            */
            
            ?>
           


        </ul>

        
<?php 
include "./includes/footer.php"; 

?>




















