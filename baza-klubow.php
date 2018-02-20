<?php
include("header.php");
?>

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
  </style>

<script type="text/javascript">
  document.title = 'Baza Klubów | transferypilkarskie.pl';
</script>

<div class="card-body center">
<div class="col-lg-6">
    <div class="input-group search-box">
      <input type="text" class="form-control" placeholder="Wyszukiwarka jeszcze nie działa..." readonly  disabled aria-label="Search for...">
      <!-- <span class="input-group-btn" style="margin-left: 1rem">
        <button class="btn btn-secondary" type="button">Szukaj</button>
      </span> -->
    </div>
  </div>
  </div>
</div>


  <div class="row center" id="karty">
    <?php
    $zapytanie = $DB_con->query("SELECT * FROM klub");
    foreach ($zapytanie as $wiersz) {
    ?>
      <div class="card mr-c kluby" style="width: 20rem;margin-bottom: 5px;" id="<?php echo $wiersz['id']?>">

        <div class="card-body">

           <div class="col-md-12 text-center">
             <img src="<?php echo $wiersz['logo'];?>" class="img-responsive rounded mx-auto d-block" alt="png" style="width:84px; height:84px;">
      </div>

    </div>
    <div class="card-footer text-center">
      <b><?php echo $wiersz['nazwa']?></b>
    </div>
    </div>
    <?php
  }
  $zapytanie->closeCursor();
    ?>




</div>

<script type="text/javascript">
$('.kluby').on("click", function(){
 //  console.log(this.id);
   window.location.href = "klub-info.php?id="+this.id;
});
</script>


<?php include("footer.php");?>
