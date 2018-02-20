<?php
  include("header.php");
  $id_transferu = $_REQUEST['id'];
  $transfer->usunTransfer($id_transferu);
  $user->redirect("index.php");

  // TODO: Dodac powiadomienie o usunieciu transferu i logi (kto, kiedy)



?>

<div class="alert alert-info" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
    Transfer o id: <strong><?php echo $id_transferu;?></strong> został pomyślnie usunięty.

</div>
