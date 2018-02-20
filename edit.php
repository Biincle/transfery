<?php
  include("header.php");
  $id_transferu = $_REQUEST['id'];

  if($userRow['uprawnienia'] == 'admin'){

  }else{
    $user->redirect('index.php');
  }







?>
<script type="text/javascript">
  document.title = "Edycja | Transferypilkarskie.pl";
</script>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
      <form method="post">
        <div class="row">
        <div class="col">
        <div class="form-group zawodnik-box">
          <label for="exampleInputEmail1">Zawodnik *</label>
          <input type="hidden" name="ukryty" value="">
          <input type="text" class="form-control" placeholder="wpisz imie lub nazwisko" name="zawodnik" id="" value="Zawodnik_1">
          <div class="wynikSzukania"></div>
        </div>
      </div>
      <div class="col">
        <div class="form-group search-box">
          <label for="exampleInputEmail1">Nowy Klub: *</label>
          <input type="text" class="form-control" placeholder="..." name="nowy_klub">
          <div class="result"></div>
        </div>
        <div class="form-group">
           <label>Typ Transferu: *</label>
           <select class="form-control" name="typ">
             <option>Transfer</option>
             <option>Wypożyczenie</option>
             <option>Koniec umowy</option>
           </select>
         </div>
      </div>

      </div>




              <div class="input-group col-md-6" style="margin-top:10px;border-left:2px solid #009688">
                <span class="input-group-addon">Kwota:</span>
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="kwota">
                <span class="input-group-addon">zł</span>
              </div>



              <button type="submit" class="btn btn-success" style="float:right;" name="transfer_wyslano">Dodaj</button>


    </form>
  </div>
    </div>
  </div>

</div>
