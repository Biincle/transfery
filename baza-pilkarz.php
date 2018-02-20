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
  document.title = 'Baza piłkarzy | transferypilkarskie.pl';
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

<div class="alert alert-info brakWynikow">
  Nie znaleziono szukanego pilkarza w bazie danych!
</div>
  <div class="row center" id="karty">
    <?php
    $zapytanie = $DB_con->query("SELECT * FROM pilkarz");
    foreach ($zapytanie as $wiersz) {
    ?>
      <div class="card mr-c pilkarze" style="width: 20rem;margin-bottom: 10px;" id="<?php echo $wiersz['id']?>">

        <div class="card-body">

           <div class="col-md-12 text-center">
             <img src="<?php echo $wiersz['zdjecie'];?>" class="img-responsive rounded mx-auto d-block" alt="png" style="width:84px; height:84px;">
      </div>

    </div>
    <div class="card-footer text-center">
      <b><?php echo $wiersz['imie'].' '.$wiersz['nazwisko']?></b>
    </div>
    </div>
    <?php
  }
  $zapytanie->closeCursor();
    ?>

<script type="text/javascript">
$(document).ready(function() {
  $('.brakWynikow').hide();
$('.search-box input[type="text"]').on("keyup input", function(){
    /* Get input value on change */
    $('.brakWynikow').hide();
    var inputVal  = $(this).val();
   var resultDropdown = $(".card");
    console.log(inputVal);
    if(inputVal.length){
        $.get("szukajka.php", {zawodnik: inputVal}).done(function(data){
            // Display the returned data in browser
            //resultDropdown.html(data);
            console.log("Zwrot: " + data);
            resultDropdown.html(data);
        });
    } else{
        resultDropdown.empty();
        $('.brakWynikow').show();
    }
});
$('.search-box input[type="text"]').focusout(function(){
    console.log("focus out");
    //SELECT *;
});
$('.pilkarze').on("click", function(){
 //  console.log(this.id);
   window.location.href = "pilkarz-info.php?id="+this.id;
});
});
</script>

  <!-- <div class="card" style="margin-top: 20px;">
    <div class="card-body">
      <div class="row">
       <div class="col-md-12 text-center">
         <img src="https://sortitoutsi.net/uploads/face/7458500.png" class="img-responsive rounded mx-auto d-block" alt="png" style="width:84px; height:84px;">
  </div>
  </div>
</div>
<div class="card-footer text-center">
  <b>Leo Messi</b>
</div>
</div>
<div class="card" style="margin-top: 20px;">
  <div class="card-body">
    <div class="row">
     <div class="col-md-12 text-center">
       <img src="https://sortitoutsi.net/file/image/33241" class="img-responsive rounded mx-auto d-block" alt="png" style="width:84px; height:84px;">
     </div>
   </div>
 </div>
  <div class="card-footer text-center">
    <b>Żółw Ninja</b>
  </div>
</div> -->


</div>


<?php include("footer.php");?>