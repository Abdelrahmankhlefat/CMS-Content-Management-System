<?php include "./includes/Aheader.php"; ?> 

    <div id="wrapper">


    <!-- navigation -->

        <?php include "./includes/Anavigation.php";
        
        ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Welcome to Admin 
                            <small>Comments Page</small>
                        </h1>

<?php 

    if(isset($_GET['source'])){
        $source = $_GET['source']; 
    }else{ 
        $source = ''; 
    }


    

    switch($source) { 
        case 'add_post'; 
        include "includes/add_post.php"; 
        
    break;

        case 'edit_post'; 
        include "includes/edit_post.php";
    break;



        default :
        include "includes/view_all_comments.php"; 
    break; 

    }


?> 





                          
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "./includes/Afooter.php"; ?>