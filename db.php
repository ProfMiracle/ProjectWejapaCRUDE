<?php

try {
    $con = mysqli_connect('127.0.0.1', 'root', '', 'asg');
} catch (\Throwable $th) {
    throw $th;
}

session_start();

function getUsername($id=NULL){
    global $con;
    $u = mysqli_fetch_object(mysqli_query($con, "SELECT * from user where id = $id"));
    return $u->username;
}