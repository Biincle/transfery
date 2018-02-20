<?php
include("header.php");
if(isset($_REQUEST['id'])){
  $id= $_REQUEST['id'];
}


?>
<script type="text/javascript">
  document.title = "<?php echo $transfer->getName($id, 'imie').' '.$transfer->getName($id, 'nazwisko')?> | transferypilkarskie.pl";
</script>
    <div class="card" style="margin-top: 20px;">

      <div class="card-body">
        <div class="row">
         <div class="col-md-12 text-center">
           <img src="<?php echo $transfer->getName($id, 'profilowe')?>" class="img-responsive rounded mx-auto d-block" alt="png" style="width:94px; height:94px;">
    </div>
    </div>
  </div>
  <div class="card-footer text-center" style="font-size: 20px;">
    <b><?php echo $transfer->getName($id, 'imie').' '.$transfer->getName($id, 'nazwisko')?></b>
  </div>
  </div>


  <div class="card-deck">
    <div class="card" style="margin-top: 20px;font-size: 18px;">
    <div class="card-body">
      <div class="row">
       <div class="col-md-12 text-center">
         <span class="text-center">Data urodzenia: <?php echo $transfer->getName($id, 'data_urodzenia');?></span>
       </div>
     </div>
   </div>
  </div>

  <div class="card" style="margin-top: 20px;font-size: 18px;">
  <div class="card-body">
    <div class="row">
     <div class="col-md-12 text-center">
       <span class="text-center">Wiek: <?php echo $transfer->getName($id, 'wiek');?></span>
     </div>
   </div>
 </div>
</div>

<div class="card" style="margin-top: 20px;font-size: 18px;">
<div class="card-body">
  <div class="row">
   <div class="col-md-12 text-center">
     <span class="text-center">Narodowość: <?php echo $transfer->getName($id, 'narodowosc');?></span>
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
          <span class="text-center">Wzrost: <?php echo $transfer->getName($id, 'wzrost');?> cm</span>
        </div>
      </div>
    </div>
</div>

<div class="card" style="margin-top: 20px;font-size: 18px;">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 text-center">
        <span class="text-center">Lepsza noga: <?php echo $transfer->getName($id, 'lepsza_noga');?></span>
      </div>
    </div>
  </div>
</div>

<div class="card" style="margin-top: 20px;font-size: 18px;">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12 text-center">
        <span class="text-center">Pozycja: <?php echo $transfer->getName($id, 'pozycja');?></span>
      </div>
    </div>
  </div>
</div>

</div>

<?php include("footer.php");?>
