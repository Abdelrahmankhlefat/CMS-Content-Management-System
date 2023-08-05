<?php include "./includes/Aheader.php"; ?> 

    <div id="wrapper">



    <?php 
        global $connection;
    ?> 

    <!-- navigation -->

        <?php include "./includes/Anavigation.php"; ?>









        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Welcome 

                         
                            <?php echo  "  ". $_SESSION['username'] ?>         <small><?php echo $_SESSION['user_role'];  ?></small>
                        </h1>
           
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php 
                    
                    $query = "SELECT * FROM posts"; 
                    $select_all_posts = mysqli_query($connection, $query); 
                  $posts_count =  mysqli_num_rows($select_all_posts); 
                    
                    ?>




                  <div class='huge'><?php echo $posts_count; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                    
                     $comments_count = findCount('comments');
                    ?>
                     <div class='huge'><?php echo $comments_count; ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                           $users_count =  findCount('users');
                    ?>
                    <div class='huge'><?php echo $users_count; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php $cats_count =  findCount('categories'); ?>
                        <div class='huge'> <?php echo $cats_count; ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
          <?php

            $posts_draft_count = findStats('posts','post_status','draft');
           
            $posts_published_count = findStats('posts','post_status','published');

            $unapproved_comments_count = findStats('comments','comment_status','unapproved');
        
            $subscribers_count = findStats('users','user_role','subscriber');
        
          ?>
                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data','Count'],
          <?php  
          $elements_text = ['All posts','Pusblished posts', 'Draft posts', 'Comments', 'Pending comments','Users', 'Categories','Subscribers'];
          $elements_count = [$posts_count,$posts_published_count,$posts_draft_count,$comments_count,$unapproved_comments_count,$users_count,$cats_count, $subscribers_count];

            for($i=0; $i < 8  ; $i++){
                echo "['{$elements_text[$i]}'" . "," . "{$elements_count[$i]}],";
            }
          ?>
           
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  <div id="columnchart_material" style="width: 100%; height: 450px;"></div>
                </div>





            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "./includes/Afooter.php"; ?>