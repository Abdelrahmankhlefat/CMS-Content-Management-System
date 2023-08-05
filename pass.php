<?php 
$pass = "123"; 

$en = base64_encode($pass);
echo "my password : ". $pass . "</br>" ;

echo "encrypted : ". $en . "</br>" ; 

$de = base64_decode($en); 

echo "decrypted : ". $de . "</br>";

?>