<?php 

require 'function.php';

if(isset($_SESSION['login'])){
    //yauda
} else {
    //belum login
    header('location:login.php');
}

?>