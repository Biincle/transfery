<?php
  include("header.php");

?>


  </div>
  <table class="table" style="margin-top:20px;">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nick</th>
        <th scope="col">E-Mail</th>
        <th scope="col">Uprawnienia</th>
        <th scope="col">Działanie</th>
      </tr>
    </thead>
    <tbody>
  <div class="row">
    <?php


      $zapytanie = $DB_con->query("SELECT * FROM uzytkownicy");
      $zapytanie->execute();

      foreach ($zapytanie as $wiersz) {

        ?>

            <tr>
              <th scope="row"><?php echo $wiersz['id'];?></th>
              <td><?php echo $wiersz['nick'];?></td>
              <td><?php echo $wiersz['email'];?></td>
              <td><?php echo $wiersz['uprawnienia'];?></td>
              <td><a href="#">Zmień</a></td>
            </tr>


      <?php
      }

?>

</tbody>
</table>





  </div>
  <style media="screen">
    div.admin-kafelek{
      background-color: #3498db;
      color:#ecf0f1;
    }
    div.kafelek{
      background-color: #2ecc71;
    }
    div.mr{
      margin-left: 5px;
      margin-right: 5px;
    }
      @media (min-width:992px) {
  .center {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
  }
    }
  </style>
<?php include("footer.php");?>
