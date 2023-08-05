<?php 
session_start();
include "./includes/header.php";
?>

    <!-- Navigation -->
  <?php 
include "./includes/navigation.php";
include "./admin/functions.php";


if(isset($_POST['liked'])){
 // select post 
 $post_id = $_POST['post_id']; 
 $user_id = $_POST['user_id']; 


// fetch the post 
 $query = "SELECT * FROM posts WHERE post_id = $post_id "; 
 $postResult = mysqli_query($connection, $query); 
 $post = mysqli_fetch_array($postResult); 
 $likes = $post['likes'];
// update post 
mysqli_query($connection,"UPDATE posts SET likes = $likes+1 WHERE post_id=$post_id");
// create likes for post 
mysqli_query($connection, "INSERT INTO likes(user_id,post_id) VALUES($user_id, $post_id)"); 
exit();
}



if(isset($_POST['unliked'])){

    echo "unliked";


    $post_id = $_POST['post_id']; 
    $user_id = $_POST['user_id']; 


    $query = "SELECT * FROM posts WHERE post_id = $post_id "; 
    $postResult = mysqli_query($connection, $query); 
    $post = mysqli_fetch_array($postResult); 
    $likes = $post['likes'];

    mysqli_query($connection, "DELETE FROM likes WHERE post_id = $post_id AND user_id=$user_id");

    mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id = $post_id"); 
   }
 ?>

  
    <!-- Page Content -->
    <div class="container">

        <div class="row">
        <?php

if(isset($_GET['p_id'])){
  $the_post_id =  $_GET['p_id']; 

$query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id"; 
$update_views = mysqli_query($connection, $query); 


$query = "SELECT * FROM posts WHERE post_id = $the_post_id"; 
$select_all_posts_query = mysqli_query($connection, $query); 

while($row = mysqli_fetch_assoc($select_all_posts_query)){

$post_title = $row['post_title'];
$post_category = $row['post_category_id']; 
$post_author = $row['post_author'];
$post_date = $row['post_date'];
$post_image = $row['post_image'];     
$post_content = $row['post_content'];

?>
            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                     <?php
                     $query = "SELECT * FROM categories WHERE cat_id  = '{$post_category}'"; 
                    $find_cats = mysqli_query($connection,$query); 
                    while($row = mysqli_fetch_assoc($find_cats)){
                        $post_category_title = $row['cat_title'];
                    }
                     
                     
                     ?>
                    <small>post</small>
                </h1>
 






                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a> <small><?php echo $post_category_title ?></small>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="w-100" src="./images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>


                 <?php  
                    $result = mysqli_query($connection, "SELECT * FROM likes WHERE user_id= ".$_SESSION['user_id']. " AND post_id={$the_post_id}");
                    $result = mysqli_num_rows($result); 
   if(LoggedIn()){
        if($result >=1 ){
            echo '
                <div class="row">
                   <a href="post.php?p_id='.$the_post_id. '" class="pull-left btn btn-danger unlike"> <span class="glyphicon glyphicon-thumbs-down  "></span> Unlike</a>
                </div>
                <br> ' ;
              
        }else{

        echo '
        <div class="row">
         <a href="post.php?p_id='.$the_post_id. '" class="pull-left btn btn-primary like"> <span class="glyphicon glyphicon-thumbs-up  "></span> Like</a>
        </div>
                ' ;
        }
    }?>

    <?php
       $result = mysqli_query($connection, "SELECT * FROM likes WHERE post_id = $the_post_id"); 
       $numOfLikes = mysqli_num_rows($result); 
    ?>
                <br>
                <div class="row">
                    <p class="pull-left">Likes : <?php echo $numOfLikes; ?>
                    </p>
                </div>
                <div class="clearfix"></div>


<?php
}
}
else{
    header("Location: index.php");

}
?>

<?php 

 if(isset($_POST['create_comment'])){

   $the_post_id = $_GET['p_id']; 

   $comment_author = $_SESSION['username']; 
   $comment_email = $_SESSION['user_email']; 
   $comment_content = $_POST['comment_content']; 


   if(!empty($comment_author) && !empty($comment_content) && !empty($comment_email)){

   

$query = "INSERT into comments (comment_post_id, comment_author,comment_email , comment_content ,
 comment_status, comment_date )"; 

 $query .="VALUES ($the_post_id, '{$comment_author}','{$comment_email}',
 '{$comment_content}' , 'unapproved' , now())";

$create_comment_query = mysqli_query($connection,$query); 
    if(!$create_comment_query){
        die("Query failed" . mysqli_error($connection));
    }

    

 }

}
E_ALL ^ E_WARNING;

?>



 <!-- comments form --> 

        <div class ="well"> 
            
            <form role="form" action="" method="post">
                <?php if(isset($_SESSION['username'])){
                    echo '
                    <h4> leave a comment </h4> 
               <h5> commenting as '. $_SESSION['username'] . '</h5>

                <div class="form-group"> 
                    <textarea class="form-control" placeholder="Write your comment!" name="comment_content" rows="6 "></textarea>
                </div> 


                <button type="submit" name="create_comment" class="btn btn-primary">submit</button>
' ;
                }else{
                    echo '<h3><a href="login1.php"> Login</a> to be able to Like and Comment on posts</h3>';
                   
                    echo '<h4>if you dont have an account <a href="registration.php">create one here </a></h4>';
                }
                ?>
            </form>  


        </div> 



        <!-- comments query  --> 

                <?php
                    $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} AND comment_status ='Approved' "; 
                  #  $query.= "ORDER by comment_id DESC"; 
                
                    $select_comment_query = mysqli_query($connection,$query); 
                    if(!$select_comment_query){ 
                        die("ERROR : ". mysqli_error($connection)); 
                    }
                
                while($row= mysqli_fetch_assoc($select_comment_query)){
                    $comment_date = $row['comment_date']; 
                    $comment_content = $row['comment_content']; 
                    $comment_author = $row['comment_author']; 
                
                    ?>


                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"> <?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?> 
                    </div>
                    <?php echo '<hr>' ?>
                </div>








              
              <?php  } 

               ?>

                
                
                
                












             
                <!-- Comment 
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                             Nested Comment 
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                         End Nested Comment 
                    </div>
                </div>

                -->

                

                

               
              


            </div>

            <!-- Blog Sidebar Widgets Column -->
           <?php include "./includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        
<?php 
include "./includes/footer.php"; 

?>


<script>
    $(document).ready(function(){
        var post_id = <?php echo $the_post_id; ?>;
        var user_id = <?php echo $_SESSION['user_id'];?>; 

        //like 
        $('.like').click(function(){
           $.ajax({
               url: "post.php?p_id=<?php echo  $the_post_id; ?>",
               type: 'post',
               data: {
                   'liked' :1, 
                   'post_id' : post_id, 
                   'user_id' : user_id
               }
           });
        })


        // unlike 
        $('.unlike').click(function(){
           $.ajax({
               url: "post.php?p_id=<?php echo  $the_post_id; ?>",
               type: 'post',
               data: {
                   'unliked' :1, 
                   'post_id' : post_id, 
                   'user_id' : user_id
               }
           });
        });
    })
</script>