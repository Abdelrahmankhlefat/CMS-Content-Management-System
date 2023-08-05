
 <?php  include "includes/header.php"; ?>


<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">


<?php 
E_ALL ^ E_WARNING;






if(isset($_POST['submit'])){
    $to = "abedalrahmankhlefat@gmail.com"; 
    $subject = wordwrap($_POST['subject'],70); 
    $body = $_POST['body']; 
    $header = "From: " . $_POST['email']; 
    mail($to,$subject,$body,$header);
}


?>

<section id="login">
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <div class="form-wrap">
            <h1>Contact</h1>
</br>
                <form role="form" action="contact.php" method="post" id="contact-form" autocomplete="off">
                    <h5 style="text-align:center;"><?php if(isset($_POST['submit'])) echo "mail sent"; ?></h5>
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input required type="email" name="email" id="email" class="form-control" placeholder="Enter Your E-mail address">
                    </div>
                     <div class="form-group">
                        <label for="subject" class="sr-only">Subject</label>
                        <input required type="subject" name="subject" id="subject" class="form-control" placeholder="Enter the subject please">
                    </div>
                    <div class="form-group">
                <textarea name="body" id="body" class="form-control" cols="30" rows="5" placeholder="Start typing the body of your message here "></textarea>
                </div>
                    <input type="submit" name="submit" id="btn-send" class="btn btn-custom btn-lg btn-block" value="Send">
                </form>
             
            </div>
        </div> <!-- /.col-xs-12 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->
</section>


    <hr>



<?php include "includes/footer.php";?>
