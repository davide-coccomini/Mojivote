<?php
include("config.php");

header('Location: '.'../index.php');
session_start();
session_unset();
session_destroy();


setcookie("login",0,time() + (10 * 365 * 24 * 60 * 60),'/');
?>