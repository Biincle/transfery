<?php
include("header.php");

if(isset($_REQUEST['id'])){
  $id= $_REQUEST['id'];
}

?>
<script type="text/javascript">
  document.title = '<?php echo $transfer->clubManager($id, 'nazwa')?> | transferypilkarskie.pl';
</script>
  <div class="card" style="margin-top: 20px;">

    <div class="card-body">
      <div class="row">
       <div class="col-md-12 text-center">
         <img src="<?php echo $transfer->clubManager($id, 'logo')?>" class="img-responsive rounded mx-auto d-block" alt="png" style="width:94px; height:94px;">
       </div>
     </div>
   </div>
      <div class="card-footer text-center" style="font-size: 20px;">
        <b><?php echo $transfer->clubManager($id, 'nazwa')?></b>
      </div>
  </div>


  <div class="card-deck">
    <div class="card" style="margin-top: 20px;font-size: 18px;">
    <div class="card-body">
      <div class="row">
       <div class="col-md-12 text-center">
         <span class="text-center">Data założenia: <?php echo $transfer->clubManager($id, 'data_zalozenia')?></span>
       </div>
     </div>
   </div>
  </div>

  <div class="card" style="margin-top: 20px;font-size: 18px;">
  <div class="card-body">
    <div class="row">
     <div class="col-md-12 text-center">
       <span class="text-center">Liga: <?php echo $transfer->clubManager($id, 'liga')?></span>
     </div>
   </div>
 </div>
</div>

<div class="card" style="margin-top: 20px;font-size: 18px;">
<div class="card-body">
  <div class="row">
   <div class="col-md-12 text-center">
     <span class="text-center">Aktualne miesjce w lidze: -</span>
   </div>
 </div>
</div>
</div>
</div>

<div class="card-deck">
  <div class="card" style="margin-top: 20px;font-size: 18px;">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12 text-center">
          <span class="text-center">Kapitan: Brak danych</span>
        </div>
      </div>
    </div>
</div>

<div class="card" style="margin-top: 20px;font-size: 18px;">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 text-center">
        <span class="text-center">Ilość zawodników: <?php echo $transfer->clubManager($id, 'liczba_zawodnikow')?></span>
      </div>
    </div>
  </div>
</div>

<div class="card" style="margin-top: 20px;font-size: 18px;">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 text-center">
        <span class="text-center">Trener: Brak Danych</span>
      </div>
    </div>
  </div>
</div>

</div>

<?php include("footer.php");?>
