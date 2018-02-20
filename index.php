<?php
include("header.php");
?>
      <!-- <div class="karty"> -->
      <style media="screen">
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
      .transfer:hover{
        cursor: pointer;
        background-color: transparent;
      }
      </style>
      <script type="text/javascript">
          document.title = 'Strona Główna - Transfery';
      </script>

<div class="row center">

  <?php
    $zapytanie = $DB_con->query("SELECT * FROM transfer");

    foreach ($zapytanie as $wiersz) {
    //   echo $wiersz['id_pilkarz'].' kwota: '.$wiersz['kwota'];
    //   echo $transfer->getName($wiersz['id_pilkarz'], 'imie');
    // echo $transfer->getName($wiersz['id_pilkarz'], 'nazwisko');


    ?>
    <div class="card mr-c transfer" style="width: 20rem;margin-bottom: 5px;" id="<?php echo $wiersz['id']?>">
      <div class="card-body">
        <div class="card-title">
          <img src="<?php echo $transfer->getName($wiersz['id_pilkarz'], 'profilowe')?>" class="img-responsive rounded" alt="png" width="44" height="44">
          <span class="card-text"><?php echo $transfer->getName($wiersz['id_pilkarz'], 'imie').' '.$transfer->getName($wiersz['id_pilkarz'], 'nazwisko');?></span>
          <span class="badge badge-secondary" style="float:right;"><?php echo $wiersz['typ'];?></span>
        </div>

            <div class="col-md-2 cien" style="width:50px;height:50px;float:left;">
              <img src="<?php echo $transfer->clubManager($wiersz['id_klub'], 'logo') ?>" class="img-responsive" alt="<?php echo $transfer->clubManager($wiersz['id_klub'], 'nazwa')?>" width="44" height="44">
            </div>
            <div class="col-md-2" style="float:left;width:60px;height:50px;text-align:center;position: absolute;left: 37%;">
                <span class="oi oi-arrow-right arrow-style" aria-hidden="true" title="strzałek"></span>
            </div>
            <div class="col-md-2 cien" style="width:50px;height:50px;float:right;">
              <img src="<?php echo $transfer->clubManager($wiersz['id_nowy_klub'], 'logo')?>" class="img-responsive" alt="<?php echo $transfer->clubManager($wiersz['id_nowy_klub'], 'nazwa')?>" width="44" height="44">
            </div>

      </div>


              <div class="card-footer text-muted" style="text-align:center;">
                  <span class="price"><?php echo $wiersz['kwota']?> <?php echo $ustawienia->waluta();?></span>
            </div>
    </div>

    <?php
    }

    $zapytanie->closeCursor();
  ?>



          <!-- TODO:
              Karty nie są responsywne - na telefonie nie działają tak jak powinny. - Do poprawy
         -->


       </div> <!-- <== div karty -->
      <!--  </div> -->
<?php include("footer.php");?>
