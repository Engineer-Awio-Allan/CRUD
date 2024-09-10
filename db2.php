<?php
$conn = mysqli_connect("localhost","root","","awio");
if(!$conn){
    die("conection fail");
}
echo "connection sucessful";

?>