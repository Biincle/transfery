<?php
  include("header.php");
  $id = $_REQUEST['id'];
  $type = $_REQUEST['type'];
  //$transfer->usunTransfer($id_transferu);
  //$user->redirect("index.php");

  // TODO: Dodac powiadomienie o usunieciu transferu i logi (kto, kiedy)
if($type == 'transfer'){
  $transfer->usunTransfer($id);
  echo "Transfer o id".$id." zostal usuniety!";
    $user->redirect("index.php");
} else if($type == 'pilkarz'){
    $transfer->usunPilkarz($id);
  echo "Pilkarz o id".$id." zostal usuniety!";
    $user->redirect("index.php");
} else if($type == 'klub'){
    $transfer->usunKlub($id);
    echo "Klub o id".$id." zostal usuniety!";
    $user->redirect("index.php");
}


?>
