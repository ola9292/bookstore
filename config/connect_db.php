
<?php 

//connect to database(host,user,password,db name)
$conn = mysqli_connect('127.0.0.1','root','','bookstore');

if(!$conn){
    echo 'Connection error:' . mysqli_connect_error();
}

?>