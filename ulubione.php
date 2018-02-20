<?php
include("header.php");

if(isset($_REQUEST['id'])){
  echo "id:".$_REQUEST['id'];
}else {
  echo "id nie zostało ustalone!";
}
?>
<script type="text/javascript">
    document.title = 'Ulubione | transferypilkarskie.pl';
</script>
<style media="screen">
  .i-am-centered { margin: auto; max-width: 1000px;}
  .pilkarze{margin-top:20px;}
</style>
<div class="row">
    <div class="col-md-3 col-md-offset-3">
      <div class="card" id="pilkarz">
        <div class="card-body">
          Piłkarz
        </div>
      </div>
    </div>
    <div class="col-md-3 col-md-offset-3">
      <div class="card" id="klub">
        <div class="card-body">
          Klub
        </div>
      </div>
    </div>
    <div class="col-md-3 col-md-offset-3">
      <div class="card" id="liga">
        <div class="card-body">
          Liga
        </div>
      </div>
    </div>

</div>

<div class="pilkarze" id="listaPilkarzy">
<div class="row">
  <?php
  $zapytanie = $DB_con->query("SELECT * FROM pilkarz");

  foreach ($zapytanie as $wiersz) {
  ?>
  <div class="col-md-2">
    <div class="card pilkarz-blok" id="<?php echo $wiersz['id'];?>">
      <div class="card-body">
        <?php echo $wiersz['imie'];?>
      </div>
    </div>
  </div>

  <?php
}

$zapytanie->closeCursor();
  ?>

 </div>
</div>




<script type="text/javascript">
    document.title = 'Ulubione | transferypilkarskie.pl';

    // A $( document ).ready() block.
  $( document ).ready(function() {


    var pilkarz = {id: ''};
    var click = 0;
    $("#listaPilkarzy").css({"display":"none"});
    $( "#pilkarz" ).click(function() {


      if(click == 0){
      $("#listaPilkarzy").css({"display":"block"});
      click +=1;
    }else if(click == 1){
      $("#listaPilkarzy").css({"display":"none"});
      click = 0;
    }
    });


    //klikanie na blok pilkarza.
    $( ".pilkarz-blok" ).click(function() {
    //  alert($(this).attr('id'));

    if(pilkarz['id'] == ''){
      $(this).css({"background-color":"#2ecc71"});
      var id = $(this).attr('id');

      pilkarz['id'] = id;

      console.log("dodaje id: " + pilkarz['id']);
} else {
  $(this).css({"background-color":"#fff"});
  console.log(pilkarz['id']);
  pilkarz['id'] = '';
  console.log("Wyczyszczone.");
}
    });


  });
</script>












<?php
include("footer.php");
?>
