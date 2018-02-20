<?php
  include('header.php');
?>
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-expanded="true">Użytkownicy <a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#transfery" role="tab" aria-controls="transfery" aria-expanded="true">Transfery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" id="home-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-expanded="true">Edytuj Newsy</a>
      </li>

    </ul>
  </div>

  <div class="tab-content" id="myTabContent">
    <!-- TRANSFER PANEL -->
     <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
  <div class="card-body">
        <?php
        $zapytanie = $DB_con->query("SELECT * FROM uzytkownicy");

        foreach ($zapytanie as $wiersz) {
          ?>
            <ul>
              <li><?php echo $wiersz['nick'].' '.$wiersz['email'].' Uprawnienia: '.$wiersz['uprawnienia'];?> <a href="#">Zarządzaj</a></li>
            </ul>



          <?php
        }
        ?>
  </div>
</div>
<!-- TRANSFER PANEL -->

<!-- NEWS PANEL -->
<div class="tab-pane fade" id="transfery" role="tabpanel" aria-labelledby="transfery-tab">
<div class="card-body">
<h4 class="card-title">News</h4>
<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
<a href="#" class="btn btn-primary">Go somewhere</a>
</div>
</div>
<!-- NEWS PANEL -->







    </div>
  </div>
</div>
<script type="text/javascript">
    document.title = 'Admin | Transferypilkarskie.pl';
</script>
<?php
include('footer.php');
?>
