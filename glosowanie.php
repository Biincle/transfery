<?php
include_once 'class/DatabaseConnect.php';




if($_POST) {

if($_POST['value'] == "tak"){
//  echo "No zwrócił ino tak i id:".$_POST['id'];
  try {
    $query = $DB_con->prepare("UPDATE glosowanie SET tak = tak+1 WHERE id_transfer = :id");
    $query->bindValue(":id", $_POST['id']);

    $query->execute();

    $wygasa = 24*3600; // 1 day
	  setcookie('glosowanie'.$_POST['id'], 'voted', time() + $wygasa, '/'); // Place a cookie
  } catch (\Exception $e) {
    echo $e->getMessage();
  }

}else if($_POST['value'] == "nie"){
  try {
    $query = $DB_con->prepare("UPDATE glosowanie SET nie = nie+1 WHERE id_transfer = :id");
    $query->bindValue(":id", $_POST['id']);

    $query->execute();

    $wygasa = 24*3600; // 1 day
	  setcookie('glosowanie'.$_POST['id'], 'voted', time() + $wygasa, '/'); //Ustawiamy ciastek
  } catch (\Exception $e) {
    echo $e->getMessage();
  }
}else {
  echo "Przy dodawaniu głosu wystąpił nieoczekiwany błąd!";
}
}


if($_GET){
  if($_GET['value'] == "tak"){
    echo $transfer->ileGlosow($_GET['id'], 'tak');
  }else if($_GET['value'] == "nie"){
      echo $transfer->ileGlosow($_GET['id'], 'nie');
  }
}
?>
