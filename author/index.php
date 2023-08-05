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
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php 
                    $all_posts = findStats('posts','post_author',$_SESSION['firstname'] . " " . $_SESSION['lastname']);

                    
                    ?>




                  <div class='huge'><?php echo $all_posts; ?></div>
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
    <div class="col-lg-4 col-md-6">
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
    
    <div class="col-lg-4 col-md-6">
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

            $users_count =  findCount('users');

        
          ?>
                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data','Count'],
          <?php  
          $elements_text = ['my posts','Draft posts', 'Comments', 'Pending comments','Categories'];
          $elements_count = [$all_posts,$posts_draft_count,$comments_count,$unapproved_comments_count,$cats_count];

            for($i=0; $i < 5 ; $i++){
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