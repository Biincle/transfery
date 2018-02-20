<?php
include("header.php");
if(isset($_REQUEST['name'])){
  $name = $_REQUEST['name'];
  $mail = $_REQUEST['mail'];
}else {
  $user->redirect("index.php");
}

?>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Zarejestrowano!</h1>
    <p class="lead">Pomyslnie zarejestrowano w serwisie <b>transferypilkarskie.pl</b>.</p>
    <p class="lead"><span class="oi oi-person" style="font-size:17px;color:#009688;"></span> <strong>Nick:</strong> <em><?php echo $name;?></em></p>
    <p class="lead"><span class="oi oi-person" style="font-size:17px;color:#009688;"></span> <strong>Mail:</strong> <em><?php echo $mail;?></em></p>

    <hr class="my-4">
<p>Zaloguj się aby mieć pełen dostęp do serwisu.</p>
<p class="lead">
  <a class="btn btn-primary btn-lg" href="login.php" role="button">Zaloguj</a>
</p>
  </div>
</div>
