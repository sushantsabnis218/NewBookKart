<?php
//session_start();
//unset($_SESSION["username"]);
//unset($_SESSION["pwd"]);
//unset($_SESSION["usertype"]);
session_destroy();
header("Location:login.html");
?>