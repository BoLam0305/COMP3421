<?php
session_start();
if(isset($_SESSION['ID']) && isset($_SESSION['Identity']) && isset($_SESSION['email'])){
  session_destroy();
  header("location:/HTML/index.php");
}
?>