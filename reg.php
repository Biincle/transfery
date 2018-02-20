<?php
include("header.php");
if(isset($_REQUEST['name'])){
  $name = $_REQUEST['name'];
}else {
  $user->redirect("index.php");
}

?>
<div class="alert alert-success">
    <b><?php echo $name?></b> Zostałeś pomyślnie zarejestrowany! Możesz się teraz zalogować aby dokończyć rejestrację! :)
</div>
