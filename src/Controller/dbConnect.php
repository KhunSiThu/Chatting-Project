<?php 

$conn = mysqli_connect("localhost","khun","khun","chattingDB");

if(!$conn) {
    echo mysqli_connect_error();
    die();
}