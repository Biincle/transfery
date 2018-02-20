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
?>
<script type="text/javascript">
    document.title = 'Transfer - Transferypilkarskie.pl';

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
        <div class="card-deck">
            <div class="card" style="margin-top: 20px;">
              <div class="card-body">
                <div class="row">
                 <div class="col-md-6">
                    <img src="<?php echo $transfer->getName($id_pilkarz, 'profilowe');?>" alt="<?php echo $transfer->getName($id_pilkarz, 'nazwisko');?>" class="img-responsive rounded" alt="png" width="64" height="64">
                    <span><?php echo $transfer->getName($id_pilkarz, 'imie').' '.$transfer->getName($id_pilkarz, 'nazwisko');?></span>
                    <ul class="list-group">
                      <li class="list-group-item">Narodowość: <?php echo $transfer->getName($id_pilkarz, 'narodowosc');?></li>
                      <li class="list-group-item">Data urodzenia:<?php echo $transfer->getName($id_pilkarz, 'data_urodzenia');?> </li>
                      <li class="list-group-item">Wiek: <?php echo $transfer->getName($id_pilkarz, 'wiek');?></li>
                      <li class="list-group-item">Kwota transferu: <?php echo $transfer->getId($id_transferu, 'kwota');?></li>
                      <li class="list-group-item">Poprzedni klub: <?php echo $transfer->clubManager($id_klub, 'stary_klub');?></li>
                      <li class="list-group-item">Nowy klub: <?php echo $transfer->clubManager($id_transferu, 'nowy_klub');?></li>

                  </ul>
                 </div>

              </div>
              <div class="card-footer text-muted text-center">
              Informacja pochodzi ze strony: <b>tutaj_strona_.domena</b>
              </div>
            </div>
          </div>

          <div class="card" style="margin-top: 20px;">
            <div class="card-body">
               <div class="row">
                 <div class="col-md-6">
                   <img src="<?php echo $transfer->clubManager($id_nowy_klub, 'logo');?>" alt="<?php echo $transfer->clubManager($id_nowy_klub, 'nazwa');?>" class="img-responsive rounded" alt="png" width="64" height="64">
                   <span><?php echo $transfer->clubManager($id_nowy_klub, 'nazwa');?></span>
                   <ul class="list-group">
                     <li class="list-group-item">Data założenia:<?php echo $transfer->clubManager($id_nowy_klub, 'data_zalozenia');?> </li>
                     <li class="list-group-item">Liga:</li>
                     <li class="list-group-item">Aktualne miesjce w lidze:</li>
                     <li class="list-group-item">Trener:</li>
                     <li class="list-group-item">Ilość zawodników:</li>
                     <li class="list-group-item">Kapitan:</li>

                   </ul>
                 </div>
               </div>
                <div class="card-footer text-muted text-center">
                  Informacja pochodzi ze strony: <b>tutaj_strona_.domena</b>
                </div>
               </div>
               </div>
             </div>
             <div class="card" style="margin-top: 20px;">
               <div class="card-body">
                  <div class="row">
                    <div class="col-md-4" style="text-align: center;">
                      <img src="<?php echo $transfer->clubManager($id_klub, 'logo');?>" alt="<?php echo $transfer->clubManager($id_klub, 'logo');?>" class="img-responsive rounded" alt="png" width="256" height="256"></br>
                      <span style="font-size: 28px; text-align: center;"><?php echo $transfer->clubManager($id_klub, 'nazwa');?></span>
                   </div>
                  <!-- SZCZAŁEK -->
                  <div class="col-md-4" style="text-align: center;">
                    <span class="oi oi-arrow-right" title="arrow" aria-hidden="true" style="margin-top: 85px; font-size: 7em; font-weight: 900;"></span>
                  </div>
                   <!-- SZCZAŁEK -->
                   <div class="col-md-4" style="text-align: center;">
                     <img src="<?php echo $transfer->clubManager($id_nowy_klub, 'logo');?>" alt="<?php echo $transfer->clubManager($id_nowy_klub, 'nazwa');?>" class="img-responsive rounded" alt="png" width="256" height="256"></br>
                     <span style="font-size: 28px; text-align: center;"><?php echo $transfer->clubManager($id_nowy_klub, 'nazwa');?></span>
                   </div>
                  </div>
                  </div>
        <div class="progress">
          <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
                </div>
<?php include("footer.php");?>
