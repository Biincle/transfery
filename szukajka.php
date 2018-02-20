<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include_once 'class/DatabaseConnect.php';

  // Check connection
//$szukana_nazwa = $_REQUEST['term'];
if(isset($_REQUEST['term'])){
  $szukana_nazwa = $_REQUEST['term'];
}
if(isset($_REQUEST['zawodnik'])){
$szukany_zawodnik = $_REQUEST['zawodnik'];
}

//if(isset($_GET['term']) && $_GET['term'] != ""){
if(isset($szukana_nazwa) && $szukana_nazwa != ""){
try {

    $sql = "SELECT * FROM klub WHERE nazwa LIKE :szukane";
    $q = $DB_con->prepare($sql);
    $q->bindValue(':szukane', '%'.$szukana_nazwa.'%');
    $q->execute();
    while ($r=$q->fetch(PDO::FETCH_ASSOC)) {
       echo "<p>" . $r["nazwa"] . "</p>";
    }


} catch (Exception $e) {
  echo $e->getMessage();
}

}


//if(isset($_GET['zawodnik']) && $_GET['zawodnik'] != ""){
if(isset($szukany_zawodnik) && $szukany_zawodnik != ""){
    try {
      $sql = "SELECT * FROM pilkarz WHERE imie LIKE :szukany_zawodnik OR nazwisko LIKE :szukany_zawodnik";
        $q = $DB_con->prepare($sql);
        $q->bindValue(':szukany_zawodnik', '%'.$szukany_zawodnik.'%');
        $q->execute();
        while($r=$q->fetch(PDO::FETCH_ASSOC)){
          //echo "<p>".$r['id'].'</p>'.$r['imie'] .' '. $r['nazwisko'];
          //echo '<p>'.$r['imie'].' '.$r['nazwisko'].'- <span>'.$r['id'].'</span></p>';
          echo '<p id='.$r['id'].'>'.$r['imie'].' '.$r['nazwisko'].'</p>';
        }
    } catch (Exception $e) {
      echo $e->getMessage();
    }

}

?>
