<?php

include_once 'class/DatabaseConnect.php';
include_once 'class/class.transfer.php';



if(isset($_COOKIE['aktywacja'])){

}else{
   $user->redirect('soon.php');
 }
if(!$user->is_loggedin()){
  $info[] = "Zachęcamy do tworzenia kont :)";
}else {

$user_id = $_SESSION['user_session'];

//Ustawienia -> dodawanie ulubionych pilkarzy klubow itd.. narazie wylaczone
if($ustawienia->ulubione()){
$ulubione = $user->czy_ulubione($user_id);
if($ulubione){
 $ulubiony_info = true;
}else {
  $ulubiony_info = false;
}
}


$stmt = $DB_con->prepare("SELECT * FROM uzytkownicy WHERE id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
$nick = $userRow['nick'];
$uprawnienia = $userRow['uprawnienia'];
$email = $userRow['email'];
    }

    if(isset($_REQUEST['anuluj'])){
      $user->dodaj_ulubione($user_id, 0, 0, 0);
      $success[] = "Już nie będziesz dostawać powiadomieć o dodaniu ulubionych.";
    }


?>
<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title></title>
  <!-- Bootstrap CSS -->
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
  <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-material-design.min.css">
  <script src="js/tether.js" charset="utf-8"></script>
  <script src="js/jquery.knob.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
  <link href="open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
  <link rel="icon" href="img/test.png" type="image/x-icon" />

  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-4537226124011984",
    enable_page_level_ads: true
  });
</script>
</head>
<body class="d-flex flex-column">
  <script type="text/javascript">
  function changeTitle() {
  var title = $(document).prop('title');
  if (title.indexOf('>>>') == -1) {
      setTimeout(changeTitle, 3000);
      $(document).prop('title', '>'+title);
  }
}

changeTitle();


  </script>
  <!-- CONTENT -->

  <!-- NAV -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- <a class="navbar-brand" href="#">Ino Logo</a> -->
      <a class="navbar-left" href="index.php" style="margin-left:10px;"><img src="img/test.png" alt="" width="45" height="45"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto" style="margin-left:auto;margin-right:auto;">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Transfery <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="baza-pilkarz.php">Baza piłkarzy</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="baza-klubow.php">Baza klubów</a>
        </li>
      </ul>
      <!-- <a class="btn btn-outline-success" href="Logowanie2.html">Zaloguj</a> -->
      <?php
          if(isset($nick)){

            ?>

            <div class="btn-group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php print $nick?></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="ustawienia.php">Ustawienia</a>
                <?php if($uprawnienia == 'admin') { ?>
                <a class="dropdown-item" href="addSection.php">Dodaj</a>
                <?php } ?>
                <a class="dropdown-item" href="profil.php?id=<?php echo $user_id;?>">Twój Profil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php?logout=true">Wyloguj</a>
              </div>
            </div>
            <?php
          }else if(!isset($nick)) {
            ?>
              <!-- <a class="btn btn-outline-success" href="login.php">Zaloguj</a> -->
              <a style="font-size: 18px; text-decoration: none; color:#2ecc71;" href="login.php"><span class="oi oi-account-login" style="margin-right: 10px;"></span>Zaloguj</a>
              <?php
          }
      ?>

    </div>
  </nav>
<!-- NAV -->


<!-- CONTENT -->
<div class="container flex-grow">

      <div class="col-md-12" style="margin-top:10px;">

        <?php
          if(isset($ulubiony_info) && $ulubiony_info == false){

            ?>
            <div class="alert alert-info" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
                Dodaj swojego idola, ulubiony klub i lige tutaj: <a href="ulubione.php?id=<?php echo $user_id?>" class="alert-link">DODAJ</a> lub  <a href="?anuluj" class="alert-link">NIE DZIĘKI</a>

        </div>
<?php    } ?>


<?php


      if(isset($success)){
        foreach ($success as $success) {
        ?>
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <?php echo $success; ?>
            </div>
        <?php
        }
      }

      ?>
