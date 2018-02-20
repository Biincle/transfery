<?php

require_once 'class/DatabaseConnect.php';
  if($_GET['logout']){
    $user->logout();
    $user->redirect("index.php");
  }

?>
