<?php
  include("header.php");

?>



  <div class="row center">
    <div class="col-md-3 admin-kafelek">
      <h2>Ilość użytkowników: </h2>
        <?php
        $zapytanie = $DB_con->query("SELECT * FROM uzytkownicy");
        $zapytanie->execute();
        $count = $zapytanie->rowCount();
        echo '<h2 style="font-weight:bold">'.$count.'</h2>';
        ?>
        <a href="?user" style="color:white;">Zarządzaj użytkownikami</a>
    </div>
    <div class="col-md-3 mr kafelek">
      <h2>Ilość piłkarzy w bazie: </h2>
      <?php
        $zapytanie = $DB_con->query("SELECT * FROM pilkarz");
        $zapytanie->execute();
        $count = $zapytanie->rowCount();
        echo '<h2 style="font-weight:bold">'.$count.'</h2>';
      ?>
    </div>
    <div class="col-md-3">
      <h2>Aktywnych transferów: </h2>
      <?php
      $zapytanie = $DB_con->query("SELECT * FROM transfer");
      $zapytanie->execute();
      $count = $zapytanie->rowCount();
      echo '<h2 style="font-weight:bold">'.$count.'</h2>';
      ?>
    </div>
  </div>

  <div class="row">
    <?php
      if(isset($_REQUEST['user'])){
      $test =  $_REQUEST['user'];

      $zapytanie = $DB_con->query("SELECT * FROM uzytkownicy");
      $zapytanie->execute();

      foreach ($zapytanie as $wiersz) {
        echo $wiersz['nick'];
      }
    }




    ?>
  </div>
  <style media="screen">
    div.admin-kafelek{
      background-color: #3498db;
      color:#ecf0f1;
    }
    div.kafelek{
      background-color: #2ecc71;
    }
    div.mr{
      margin-left: 5px;
      margin-right: 5px;
    }
      @media (min-width:992px) {
  .center {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
  }
    }
  </style>
<?php

?>
