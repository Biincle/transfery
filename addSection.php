<?php
      include("header.php");

if($userRow['uprawnienia'] == 'admin'){

}else{
  $user->redirect('index.php');
}


/// Dodawanie  SECTION..


//** DODAWANIE KLUBU **
if(isset($_POST['klub_wyslano'])){
    $nazwa = trim($_POST['nazwa_klub']);
    $liga = $_POST['liga'];
    $data_z = $_POST['data'];
    $logo = $_POST['logo'];

    if($nazwa == ''){
      $error[] = "Nazwa klubu nie może być pusta!";
    }else if($liga == ''){
      $error[] = "Klub nie może być bez ligi!";
    }else if($data_z == ''){
      $error[] = "Podaj date założenia klubu!";
    }


    else {
      try {

        $stmt = $DB_con->prepare("SELECT nazwa FROM klub WHERE nazwa=:nazwa");
        $stmt->execute(array(':nazwa' => $nazwa));
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

          if($row['nazwa'] == $nazwa){
            $error[] = "Klub który aktualnie próbujesz dodać już znajduje się w bazie danych.";
          }
          else{
            //Wszystko git dodajemy klub do bazy..
            $stm = $DB_con->prepare("INSERT INTO klub VALUES(NULL, :nazwa, :id_liga, :liczba_zawodnikow, :data_zalozenia, :logo)");
            $stm->bindValue(":nazwa", $nazwa);
            $stm->bindValue(":id_liga", $liga);
            $stm->bindValue(":liczba_zawodnikow", 0);
            $stm->bindValue(":data_zalozenia", $data_z);
            $stm->bindValue(":logo", $logo);

            $stm->execute();

            if($stm){
              $success[] = "Pomyślnie dodano klub:<b> ".$nazwa."</b> do bazy danych!";
            }else {
              $error[] = "Wystapil bląd podczas dodawania klubu do bazy danych!";
            }
          }

      } catch (Exception $e) {
        echo $e->getMessage();
      }

    }
}
//**  </DODAWANIE KLUBU >**

//** DODAWANIE PIŁKARZA ** //
if(isset($_POST['pilkarz_wyslano'])){

    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $wiek = $_POST['wiek'];
    $zdjecie = $_POST['zdjecie'];
    $narodowosc = $_POST['narodowosc'];
    $aktualny_klub = $_POST['aktualny_klub'];
    $wartosc_rynkowa = $_POST['wartosc_rynkowa'];
    $data_urodzenia = $_POST['data_urodzenia'];
    $pozycja_boisko = $_POST['pozycja_boisko'];
    //update 02.01.18
    $wzrost = $_POST['wzrost'];
    $zarobki = $_POST['zarobki'];
    $lepsza_gira = $_POST['lepsza_noga'];

    if($imie == '' || $nazwisko == '' || $aktualny_klub == '' || $pozycja_boisko == ''){
      $error[] = "Nie można dodać pustego piłkarza ...";
    } else {


    $sql = "SELECT * FROM klub WHERE nazwa = :aktualny_klub";
    $q = $DB_con->prepare($sql);
    $q->bindValue(':aktualny_klub', $aktualny_klub);
    $q->execute();

    $r=$q->fetch(PDO::FETCH_ASSOC);
    $id_aktualny_klub = $r['id'];
    $q->closeCursor();

try {
// TODO: Do zrobienia dodawanie piłkarza do bazy bo aktualnie to jakies dymy się dzieją
  //$stm = $DB_con->prepare("INSERT INTO pilkarz VALUES(NULL, :imie, :nazwisko, :wiek, :zdjecie, :narodowosc, :id_aktualny_klub, :wartosc_rynkowa, :data_urodzenia, :pozycja_boisko)");
  $stm = $DB_con->prepare("INSERT INTO pilkarz VALUES(NULL, :imie, :nazwisko, :id_aktualny_klub, :data_urodzenia, :narodowosc, :wiek, :pozycja_boisko, :wartosc_rynkowa, :zdjecie, :wzrost, :lepsza_noga, :zarobki)");
  $stm->bindValue(":imie", $imie);
  $stm->bindValue(":nazwisko", $nazwisko);
  $stm->bindValue(":id_aktualny_klub", $id_aktualny_klub);
    $stm->bindValue(":data_urodzenia", $data_urodzenia);
    $stm->bindValue(":narodowosc",$narodowosc);
      $stm->bindValue(":wiek", $wiek);
    $stm->bindValue(":pozycja_boisko", $pozycja_boisko);
    $stm->bindValue(":wartosc_rynkowa", $wartosc_rynkowa);
  $stm->bindValue(":zdjecie",$zdjecie);
  $stm->bindValue(":wzrost", $wzrost);
  $stm->bindValue(":lepsza_noga", $lepsza_gira);
  $stm->bindValue(":zarobki", $zarobki);

  $stm->execute();
  if($stm){
    $success[] = "Piłkarz:<b> ".$imie." ".$nazwisko." </b>został pomyślnie dodany do bazy danych!";
  }else{
    $error[] = "Wystąpił błąd poczas doddawania piłkarza do bazy danych!";
  }

} catch (Exception $e) {
  echo $e->getMessage();
}
}


}

//** </DODAWANIE PIŁKARZA >**//

//** < DODAWANIE TRANSFERU> //
if(isset($_POST['transfer_wyslano'])){
  $id_zawodnik = $_POST['ukryty'];
  $nowy_klub = $_POST['nowy_klub'];
  $typ = $_POST['typ'];
  $kwota = $_POST['kwota'];

  $proponowane_zarobki = $_POST['proponowane_zarobki'];



  if($id_zawodnik == "" || $nowy_klub == ""){
    $error[] = "Nie można dodawać pustych transferów!";
  }else if($transfer->sprawdzCzyTakiSam($id_zawodnik, $nowy_klub)) {
    $error[]= "Próbujesz dodać transfer, który już istnieje. Przejdz na główną i <a href='index.php'>Edytuj transfer</a>";

}else {



//Pobieramy id nowego klubu
$sql = "SELECT * FROM klub WHERE nazwa = :nowy_klub";
$q = $DB_con->prepare($sql);
$q->bindValue(':nowy_klub', $nowy_klub);
$q->execute();

$r=$q->fetch(PDO::FETCH_ASSOC);
$id_nowy_klub = $r['id'];
$q->closeCursor();

$sql2 = "SELECT id_klub FROM pilkarz WHERE id = :id_zawodnik";
$q2 = $DB_con->prepare($sql2);
$q2->bindValue(':id_zawodnik', $id_zawodnik);
$q2->execute();

$r=$q2->fetch(PDO::FETCH_ASSOC);
$id_aktualny_klub = $r['id_klub'];
$q2->closeCursor();

try {

  $stm = $DB_con->prepare("INSERT INTO transfer VALUES(NULL, :id_pilkarz, :id_klub, :id_nowy_klub, :typ, :kwota, :proponowane_zarobki)");
  $stm->bindValue(":id_pilkarz", $id_zawodnik);
  $stm->bindValue(":id_klub", $id_aktualny_klub);
  $stm->bindValue(":id_nowy_klub", $id_nowy_klub);
  $stm->bindValue(':typ', $typ);
  $stm->bindValue(":kwota", $kwota);
  $stm->bindValue(":proponowane_zarobki", $proponowane_zarobki);
  $stm->execute();


if($stm){
  $last_id = $DB_con->lastInsertId();
  try {
    $q = $DB_con->prepare("INSERT INTO glosowanie VALUES(NULL, :id_transfer, 0, 0)");
    $q->bindValue(":id_transfer", $last_id);
    $q->execute();
  } catch (Exception $e) {
      echo $e->getMessage();
  }

  $success[] = "Pomyślnie dodano transfer do bazy danych! <a href='index.php'>Przejdź aby zobaczyć</a> jego id:";
}else{
  $error[] = "Wystąpił błąd podczas dodawania transferu do bazy danych!";
}

} catch (Exception $e) {
  echo $e->getMessage();
}
}


}



      if(isset($error)){
        foreach ($error as $error) {
        ?>
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <?php echo $error; ?>
            </div>
        <?php
        }
      } else if(isset($success)){
        foreach ($success as $success) {
        ?>
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <?php echo $success;?>
        </div>
        <?php
        }
      }

      ?>

<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#transfer" role="tab" aria-controls="transfer" aria-expanded="true">Transfer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#pilkarz" role="tab" aria-controls="pilkarz" aria-expanded="true">Piłkarza</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#klub" role="tab" aria-controls="klub" aria-expanded="true">Klub</a>
      </li>
    </ul>
  </div>

  <div class="tab-content" id="myTabContent">
    <!-- TRANSFER PANEL -->
     <div class="tab-pane fade show active" id="transfer" role="tabpanel" aria-labelledby="transfer-tab">
  <div class="card-body">
      <div class="col-md-9" style="margin-left:auto;margin-right:auto;">
        <!-- <div class="alert alert-success" role="alert">
        Pomyślnie dodano transfer piłkarza: <a href="#" class="alert-link">$piłkarz.name</a>.
      </div> -->
        <form method="post">
          <!-- <div class="form-row">
              <div class="col">
                  <input type="text" class="form-control" placeholder="Imię">
              </div>
              <div class="col">
                  <input type="text" class="form-control" placeholder="Nazwisko">
              </div>
          </div> -->
          <div class="row">
          <div class="col">
          <div class="form-group zawodnik-box">
            <label for="exampleInputEmail1">Zawodnik *</label>
            <input type="hidden" name="ukryty" value="">
            <input type="text" class="form-control" placeholder="wpisz imie lub nazwisko" name="zawodnik" id="">
            <div class="wynikSzukania"></div>
          </div>
          <div class="form-group search-box">
            <label for="exampleInputEmail1">Proponowane zarobki: *</label>
            <input type="text" class="form-control" placeholder="5.76" name="proponowane_zarobki">
            <small class="form-text text-muted">Podajemy w mln rocznie.</small>
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
                  <span class="input-group-addon">€</span>
                </div>



                <button type="submit" class="btn btn-success" style="float:right;" name="transfer_wyslano">Dodaj</button>


      </form>


      </div>
  </div>
</div>
<!-- TRANSFER PANEL -->




<!-- Piłkarz Panel -->
  <div class="tab-pane fade" id="pilkarz" role="tabpanel" aria-labelledby="pilkarz-tab">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
              <form class="" method="post" id="pilkarz-form">
                <div class="row">
                <div class="col">
                <div class="form-group">
                  <label for="exampleInputEmail1">Imię *</label>
                  <input type="text" class="form-control" placeholder="Imię..." name="imie">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nazwisko *</label>
                  <input type="text" class="form-control" placeholder="Nazwisko..." name="nazwisko">
                </div>
              </div>

              </div>

              <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="exampleInputEmail1">Narodowość: *</label>
                  <input type="text" class="form-control" placeholder="Narodowosc" name="narodowosc">
                  <small id="emailHelp" class="form-text text-muted">Można podawać w skrótach np. PL</small>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="wiek">Wiek piłkarza</label>
                  <input type="number" class="form-control" placeholder="28" name="wiek">
                  <small class="form-text text-muted">Można zostawić puste i podać datę urodzenia (not working)</small>
                </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="wiek">Aktualne zarobki piłkarza:</label>
                <input type="number" class="form-control" placeholder="6500000" name="zarobki">
                <small class="form-text text-muted">Zarobki roczne. (€)</small>
              </div>
          </div>

        </div>

      <div class="row">
        <div class="col">
        <div class="form-group">
          <label>Data urodzenia *</span>
          <input type="date" class="form-control" placeholder="Podaj datę urodzenia" aria-label="Username" aria-describedby="basic-addon1" name="data_urodzenia">
      </div>
    </div>
    <div class="col">
      <div class="form-group">
        <label for="wiek">Wzrost piłkarza:</label>
        <input type="number" class="form-control" placeholder="182" name="wzrost">
        <small class="form-text text-muted">Podaj w cm</small>
      </div>
  </div>
    <div class="col">
      <div class="form-group">
        <label for="wiek">Zdjęcie</label>
        <input type="text" class="form-control" placeholder="url" name="zdjecie">
      </div>
        </div>
      </div>
      </div>
        <div class="col-md-6">
          <div class="form-group search-box">
            <label for="exampleInputEmail1">Aktualny Klub: *</label>
            <input type="text" class="form-control" placeholder="..." name="aktualny_klub">
            <div class="result"></div>
          </div>
        <div class="form-group">
           <label for="exampleFormControlSelect1">Pozycja na boisku: *</label>
           <select class="form-control" name="pozycja_boisko">
             <option>Napastnik</option>
             <option>Skrzydłowy</option>
             <option>Pomocnik</option>
             <option>Obrońca</option>
             <option>Bramkarz</option>
           </select>
         </div>
         <div class="form-group">
            <label for="exampleFormControlSelect1">Lepsza Noga:</label>
            <select class="form-control" name="lepsza_noga">
              <option>Prawa</option>
              <option>Lewa</option>
            </select>
          </div>
         <div class="form-group">
           <label for="exampleInputEmail1">Przybliżona wartość rynkowa *</label>
           <input type="number" class="form-control" placeholder="100.000.000" name="wartosc_rynkowa">
           <small class="form-text text-muted">Wartość podajemy w €.</small>
         </div>
        </div>
        <button type="submit" class="btn btn-success" name="pilkarz_wyslano" style="width:100%;">Dodaj</button>
      </form>
      </div>
    </div>
  </div>
<!-- /Piłkarz Panel -->



<!-- Klub Panel -->
  <div class="tab-pane fade" id="klub" role="tabpanel" aria-labelledby="klub-tab">
      <div class="card-body">
          <div class="row">
            <div class="col-md-6" style="margin-left:auto;margin-right:auto">
                <form class="" method="post">
                  <div class="form-group">
                    <span class="input-group-addon" id="basic-addon1">Nazwa klubu</span>
                    <input type="text" class="form-control" placeholder="Podaj nazwe klubu.." aria-label="Username" aria-describedby="basic-addon1" name="nazwa_klub">
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Liga</span>
                  <select class="form-control form-control-sm" name="liga">
                    <?php
                    $sql = "SELECT * FROM liga";
                    $stm = $DB_con->query($sql);
                    $ligi = $stm->fetchAll();

                    foreach ($ligi as $liga) {
                      echo '<option value='.$liga['id'].'>'.$liga['nazwa'].'</option>';
                    }
                    ?>
                  </select>
              </div>
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Data założenia</span>
                <input type="date" class="form-control" placeholder="Podaj date założenia klubu.." aria-label="Username" aria-describedby="basic-addon1" name="data">
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Logo</span>
              <input type="text" class="form-control" placeholder="Logo (url)" aria-label="Username" aria-describedby="basic-addon1" name="logo">
          </div>
            <button type="submit" class="btn btn-success" name="klub_wyslano" style="width:100%;">Dodaj</button>
                </form>
          </div>
        </div>
      </div>
  </div>
<!-- /Klub Panel -->

    </div>
  </div>
</div>
</div>




<!-- /CONTENT -->




<!-- footer -->



  <!-- /CONTENT -->
  <style>
  .result p{
      margin: 0;
      padding: 7px 10px;
          border: 1px solid rgba(0,0,0,.26);
      border-top: none;
      cursor: pointer;
  }
  .result p:hover{
      background: #f2f2f2;
  }
  .wynikSzukania p{
      margin: 0;
      padding: 7px 10px;
          border: 1px solid rgba(0,0,0,.26);
      border-top: none;
      cursor: pointer;
  }
  .wynikSzukania p:hover{
      background: #f2f2f2;
  }
</style>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
    <!-- <script src="js/bootstrap.js"></script> -->
   <script src="https://unpkg.com/popper.js@1.12.5/dist/umd/popper.js" integrity="sha384-KlVcf2tswD0JOTQnzU4uwqXcbAy57PvV48YUiLjqpk/MJ2wExQhg9tuozn5A1iVw" crossorigin="anonymous"></script>
   <script src="https://unpkg.com/bootstrap-material-design@4.0.0-beta.3/dist/js/bootstrap-material-design.js" integrity="sha384-hC7RwS0Uz+TOt6rNG8GX0xYCJ2EydZt1HeElNwQqW+3udRol4XwyBfISrNDgQcGA" crossorigin="anonymous"></script>
   <script>
   $(document).ready(function() {
         document.title = 'Admin - Dodawanie | Transferypilkarskie.pl';
     $('body').bootstrapMaterialDesign();


     $('.search-box input[type="text"]').on("keyup input", function(){
         /* Get input value on change */
         var inputVal  = $(this).val();
         var resultDropdown = $(this).siblings(".result");
         console.log(inputVal);
         if(inputVal.length){
             $.get("szukajka.php", {term: inputVal}).done(function(data){
                 // Display the returned data in browser
                 resultDropdown.html(data);
             });
         } else{
             resultDropdown.empty();
         }
     });

     // Ustawianie kliknietego tekstu jako wynik.
     $(document).on("click", ".result p", function(){
         $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
         $(this).parent(".result").empty();
     });


      $('.zawodnik-box input[type="text"]').on("keyup input", function(){

        var szukanaWartosc = $(this).val();
        var wynik = $(this).siblings(".wynikSzukania");


        if(szukanaWartosc.length){
          $.get("szukajka.php", {zawodnik: szukanaWartosc}).done(function(data){
            //console.log(data);
            wynik.html(data);
          });
        }else {
          wynik.empty();
        }

      });

      $(document).on("click", ".wynikSzukania p", function(){
        var val = $(".wynikSzukania p").text();
    var id = $('.wynikSzukania p').get(0).id;
          $(this).parents(".zawodnik-box").find('input[type="text"]').val($(this).text());
          console.log(id);
           $('input[name="ukryty"]').val(id);
          $(this).parent(".wynikSzukania").empty();
      });



   });




   </script>
  </body>
</html>
