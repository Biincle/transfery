<?php
include("header.php");
if(isset($_REQUEST['id'])){
  $id_transferu = $_REQUEST['id'];
  $id_pilkarz = $transfer->getId($id_transferu, 'pilkarz');
  $id_klub = $transfer->getId($id_transferu, 'stary_klub');
  $id_nowy_klub = $transfer->getId($id_transferu, 'nowy_klub');
}else if(empty($_REQUEST['id'])) {
  $user->redirect("index.php");
}


$ciasteczko = 'glosowanie'.$id_transferu; // Ustawiamy nazwe ciasteczka aby można było oddać głos raz na 24h.

?>
<input type="hidden" name="tak" class="ukryty-tak">
 <input type="hidden" name="nie" class="ukryty-nie">
<script type="text/javascript">
    document.title = 'Transfer - Transferypilkarskie.pl';

    $( document ).ready(function() {

      ref(<?php echo $id_transferu;?>, 'tak');
      ref(<?php echo $id_transferu;?>, 'nie');

    $('[data-toggle="tooltip"]').tooltip();
  });


    function glos(idTransferu, value) {
	var dataFields = {'id': idTransferu, 'value': value}; // We pass the 2 arguments
	$.ajax({ // Ajax
		type: "POST",
		url: "glosowanie.php",
		data: dataFields,
		timeout: 3000,
		success: function(dataBack){
       $('.zielony').attr("disabled", true);
       $('.czerwony').attr("disabled", true);
        ref(idTransferu, value);
			},
		error: function() {
			alert("Wystapil blad!");
		}
	});
}

  function ref(idTransferu, value){
    var dataFields = {'id': idTransferu, 'value': value};
  $.ajax({
    type: "GET",
    url: "glosowanie.php",
    data: dataFields,
    success: function(data){
      //alert("zwrot:"+data);

      if(value == 'tak'){$('.tak').html(data);$(".ukryty-tak").val(data);}
      if(value == 'nie'){$('.nie').html(data);$(".ukryty-nie").val(data);}
      pobierz();
    },
    error: function(){
      alert("Blad podczas pobierania wartosci.");
    }
  });
}

function pobierz(){
  //  console.log("Sprawdzam: " + $("input[name='tak']").val() );

    var tak = Number($("input[name='tak']").val());
    var nie = Number($("input[name='nie']").val());

    var max = tak + nie; // 100%;

    var procent = tak/max * 100;
    console.log(procent);
    var procent2 = procent.toFixed(2);
    console.log(procent2);

  $('.progress-bar').attr('aria-valuemax', max).css('width',procent2+"%");
  $('.progress-bar').text(procent2+"%");
  //$('.progress-bar').attr('aria-valuemax', max);
  $('.progress-bar').attr('aria-valuenow', tak);
}

// TODO: DO DOKOŃCZENIA PRGORESS BAR.



//});
</script>



<?php
  if(isset($uprawnienia) && $uprawnienia == 'admin')
  {

?>
  <div class="row">
    <div class="btn-group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opcje transferu</button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="edit.php?id=<?php echo $id_transferu?>">Edytuj</a>
        <a class="dropdown-item" href="usun.php?id=<?php echo $id_transferu?>">Usuń</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item disabled" href="#">Potwierdz</a>
      </div>
    </div>
  </div>
<?php
}
?>
      <!--  <div class="card-deck"> -->
      <div class="row">

        <!-- CARD Zawodnik -->
            <div class="card" style="margin-top: 20px;width:35%;">
              <div class="card-header text-muted" style="text-align:center;">
                  <span>Zawodnik</span>
            </div>
              <div class="card-body">
                <div class="row">
                 <div class="col-md-2">
                    <img src="<?php echo $transfer->getName($id_pilkarz, 'profilowe');?>" alt="<?php echo $transfer->getName($id_pilkarz, 'nazwisko');?>" class="img-responsive rounded" alt="png" width="64" height="64">

                 </div>
                 <div class="col-md-10">
                   <ul class="list-group">
                     <li class="list-group-item fix"><b><?php echo $transfer->getName($id_pilkarz, 'imie').' '.$transfer->getName($id_pilkarz, 'nazwisko')?></b></li>
                     <li class="list-group-item fix">Stary klub: <a href="klub-info.php?id=<?php echo $id_klub;?>"> <?php echo $transfer->clubManager($id_klub, 'nazwa')?> </a></li>
                     <li class="list-group-item fix">Aktualne zarobki: <?php echo $transfer->getName($id_pilkarz, 'aktualne_zarobki');?> MLN €</li>
                   </ul>
                 </div>
              </div>

            </div>
                <div class="card-footer text-muted" style="text-align:center;">
                    <span>Więcej informacji o <a href="pilkarz-info.php?id=<?php echo $id_pilkarz; ?>"><?php echo $transfer->getName($id_pilkarz, 'imie').' '.$transfer->getName($id_pilkarz, 'nazwisko');?></a></span>
              </div>
          </div>
          <!-- CARD Zawodnik -->

          <!-- CARD Klub -->
              <div class="card" style="margin-top: 20px;margin-left:10px;width:35%;">
                <div class="card-header text-muted" style="text-align:center;">
                    <span>Nowy Klub (?)</span>
              </div>
                <div class="card-body">
                  <div class="row">
                   <div class="col-md-2">
                      <img src="<?php echo $transfer->clubManager($id_nowy_klub, 'logo');?>" alt="<?php echo $transfer->clubManager($id_nowy_klub, 'nazwa');?>" class="img-responsive rounded" alt="png" width="64" height="64">
                   </div>
                   <div class="col-md-10">
                     <ul class="list-group">
                       <li class="list-group-item fix"><b><?php echo $transfer->clubManager($id_nowy_klub, 'nazwa');?></b></li>
                       <li class="list-group-item fix">Liga <?php echo $transfer->clubManager($id_nowy_klub, 'liga')?></li>
                       <li class="list-group-item fix">Proponowane zarobki: <?php echo $transfer->getId($id_transferu, 'proponowane_zarobki');?> MLN €</li>
                     </ul>
                   </div>
                </div>

              </div>
                  <div class="card-footer text-muted" style="text-align:center;">
                      <span>Więcej informacji o <a href="klub-info.php?id=<?php echo $id_nowy_klub; ?>"><?php echo $transfer->clubManager($id_nowy_klub, 'nazwa');?></a></span>
                </div>
            </div>
            <!-- CARD Klub -->


          <!-- GŁOSOWANIE -->

          <div class="card" style="margin-top: 20px;margin-left:10px;width:20%;">
            <div class="card-header text-muted" style="text-align:center;">
                <span>Zagłosuj</span>
          </div>
            <div class="card-body">
              <?php
                if(isset($_COOKIE[$ciasteczko])){

              ?>
              <div class="row" style="margin-top:10px;">
                <div class="col-md-12">
                  <button type="button" name="button" class="btn btn-info" style="width:100%;">JUŻ ODDAŁEŚ GŁOS</button>
                </div>
              </div>

              <?php
            }else {
              ?>
                 <div class="row" style="margin-top:10px;">
                   <div class="col-md-6">
                    <!-- <button type="button" name="button" class="btn btn-success btn-raised" style="width:100%;">PRZEJDZIE</button> -->
                     <button type="button" name="tak" class="btn przycisk zielony" onclick="glos(<?php echo $id_transferu;?>,'tak')"><span class="oi oi-check"></span></button>
                   </div>
                   <div class="col-md-6">
                     <button type="button" name="nie" class="btn przycisk czerwony" onclick="glos(<?php echo $id_transferu;?>,'nie')"><span class="oi oi-x"></span></button>
                   </div>
                 </div>
                 <?php
               }
                 ?>
                 <div class="row" style="margin-top:25px;text-align:center;">
                   <div class="col-md-6">
                     <span class="tak" aria-tak=""></span>
                   </div>
                   <div class="col-md-6">
                     <span class="nie" aria-nie=""></span>
                   </div>
                 </div>
                 <div class="row" style="margin-top:20px;">
                   <div class="col-md-12">
              <div class="progress" style="height:100%;m">
               <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
              </div>
                 </div>
               </div>
               </div>
               </div>

                 <!-- GŁOSOWANIE -->

             </div>

              <div class="row">
                <!-- Transfer kwota -->
               <div class="card" style="margin-top: 20px;">
                 <div class="card-header text-muted" style="text-align:center;">
                     <span>Kwota transferu</span>
               </div>
                 <div class="card-body">
                   <div class="row">
                    <div class="col-md-12" style="text-align:center;">
                      <span class="counter" style="font-size:32px;font-weight:bold;"><?php echo $transfer->getId($id_transferu, 'kwota');?></span><span>€</span>
                    </div>
                 </div>
                 <!-- <div class="row">
                  <div class="col-md-12" style="text-align:center;">
                    <h6>Klauzula: <span class="price counter">5 </span><span>mln €</span></h6>
                  </div>
               </div> -->

               </div>
                 <div class="card-footer text-muted" style="text-align:center;">
                   <span>Więcej informacje nt. <a href="#">wartości piłkarzy</a></span>
               </div>
             </div>
             <!-- Transfer kwota -->


             <!-- Transfer kwota -->
            <div class="card" style="margin-top: 20px;margin-left:10px;width:70%;">
              <div class="card-header text-muted" style="text-align:center;">
                  <span>Informacje potwierdzone przez:</span>
            </div>
              <div class="card-body">

                <div class="row" style="text-align:center;">
                    <div class="col-md-4" style="margin-top:10px;">
                      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Marca.svg/1200px-Marca.svg.png" alt="" class="img-responsive" width="128">
                    </div>
                    <div class="col-md-4" style="margin-top:10px;">
                      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Marca.svg/1200px-Marca.svg.png" alt="" class="img-responsive" width="128">
                    </div>
                    <div class="col-md-4" style="margin-top:10px;">
                      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Marca.svg/1200px-Marca.svg.png" alt="" class="img-responsive" width="128">
                    </div>
                </div>
            </div>
              <div class="card-footer text-muted" style="text-align:center;">
                <span>Więcej informacje nt. <a href="#">informacji</a></span>
            </div>
          </div>
          <!-- Transfer kwota -->

           </div>



             </div>



                <style media="screen">
                  .przycisk{
                    width: 100%;
                    height: 100%;
                    color:rgba(255,255,255, 0.84);
                  }
                  .zielony{
                    background-color: #4caf50;
                  }
                  .czerwony{
                    background-color: #f44336;
                  }
                  .fix{
                    padding:10px 2px 10px 2px;
                    margin-left:25px;
                  }
                </style>
                <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $('.counter').counterUp({
                        delay: 10,
                        time: 1000
                    });
                });
                </script>
<?php include("footer.php");?>
