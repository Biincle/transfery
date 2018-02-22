<?php
  include("header.php");

  if(isset($_REQUEST['id'])){
    $id_uzytkownika = $_REQUEST['id'];
  }else if(empty($_REQUEST['id'])) {
    $user->redirect("index.php");
  }
 ?>

 <script type="text/javascript">
   document.title = "Profil | Transferypilkarskie.pl";

 </script>
  <div class="row">

      <div class="col-md-3">
        <div class="card" style="height:370px;">
          <div class="card-body">
        <div class="user-img">
          <img src="https://i.imgur.com/2NcD6gE.png" alt="Awatar użytkownika" width="128" height="128">
        </div>
        <a href="#" class="badge badge-danger">Admin</a>
        <a href="#" class="badge badge-success">Moderator</a>
        <a href="#" class="badge badge-warning">Premium</a>
        <p class="user-nick cien"><?php echo $user->dane($id_uzytkownika, 'nick');?></p>
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item active" id="list-home-list" data-toggle="tab" href="#list-home" role="tab" aria-controls="home">Informacje o użytkowniku</a>
          <a class="list-group-item list-group-item-action disabled" id="list-profile-list" data-toggle="tab" href="#list-profile" role="tab" aria-controls="profile">Napisz wiadomość</a>
      </div>
       </div>
     </div>
      </div>
      <div class="col-md-6">

 <div class="cien">
   <div class="tab-content" id="nav-tabContent">
     <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">Info</div>
     <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">Wiadomość</div>
   </div>
 </div>
      </div>
      <div class="col-md-3">
        <div class="card" style="height:370px;">
          <div class="card-header">
              Aktywność użytkownika
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-12" style="text-align:center;margin-top:5px;border-bottom:2px solid #2196f3;">
                <span>Oddanych Głosów:</span>
                <h4 class="counter">500</h4>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12" style="text-align:center;margin-top:5px;border-bottom:2px solid #2196f3;">
                <span>Komentarzy:</span>
                <h4 class="counter">500</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" style="text-align:center;margin-top:5px;border-bottom:2px solid #2196f3;">
                <span>Polubień:</span>
                <h4 class="counter">13300</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" style="text-align:center;margin-top:5px;border-bottom:2px solid #2196f3;">
                <span>Rekomendacji:</span>
                <h4 class="counter">5</h4>
              </div>
            </div>

       </div>
     </div>
      </div>

  </div>





<style media="screen">
  .user-img{
    padding: 5px 10px 5px 10px;
    text-align: center;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
    border-radius: 3px;
  }
  .user-img img{
    margin-left:auto;
    margin-right: auto;
  }
  .user-nick{
    text-align: center;
    margin-top:5px;
    font-weight: bold;
  }
  .cien {
    -webkit-box-shadow: inset 1px 1px 10px 1px #F5F5F5;
    box-shadow: inset 1px 1px 10px 1px #F5F5F5;
    border-radius: 2px;
    padding: 10px;
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
