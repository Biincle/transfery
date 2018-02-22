<?php

class transfer {
  private $db;

  function __construct($DB_con)
  {
    $this->db = $DB_con;
  }

    public $imie = "";
    public $nazwisko = "";
    public $stary_klub_img = "";
    public $nowy_klub_img = "";
    public $kwota = 0;
    public $typ_tansferu = "";


/**
 * Funkcja zwraca informacje o pilkarzu.
 */
    public function getName($id, $type){
        try
        {
           $stmt = $this->db->prepare("SELECT * FROM pilkarz WHERE id=:id");
           $stmt->execute(array(':id'=>$id));

           $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

           if($type == 'imie'){
           return $userRow['imie'];
         }else if($type == 'nazwisko'){
           return $userRow['nazwisko'];
         }else if($type == 'profilowe'){
           $profilowe = $userRow['zdjecie'];
           if($profilowe == 'Brak'){
             return "https://i.imgur.com/2NcD6gE.png";
           }else {
             return $profilowe;
           }
         }else if($type == 'narodowosc'){
           return $userRow['narodowosc'];
         }else if($type == 'data_urodzenia'){
           return $userRow['data_urodzenia'];
         }else if($type == 'wiek'){
           return $userRow['wiek'];
         }else if($type == 'pozycja'){
           return $userRow['pozycja'];
         }else if($type == 'aktualne_zarobki'){
           if($userRow['aktualne_zarobki'] == null || $userRow['aktualne_zarobki'] == '' ){
             return '<small>Brak informacji</small>';
           }else {
           return $userRow['aktualne_zarobki'];
         }
         }else if($type == 'wzrost'){
           return $userRow['wzrost'];
         }else if($type == 'lepsza_noga'){
           return $userRow['lepsza_noga'];
         }

      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }


/**
 * Funkcja zwaraca informacje o klubie
 * INPUT -> id_klub
 */
    public function clubManager($id, $type){
      if($id == null && $type == 'logo'){
        return 'img/brak_klubu.png';
      }else if($id == null && $type == 'nazwa') {
        return '';
      } else if($id == null && $type == 'data_zalozenia'){
        return '-';
      }else {
      try {
        $q = $this->db->prepare("SELECT * FROM klub WHERE id=:id");
        $q->execute(array(':id' => $id));
        $clubRow = $q->fetch(PDO::FETCH_ASSOC);

        if($type == 'logo'){
          if($clubRow['logo'] == 'Brak'){
            return "https://i.imgur.com/2NcD6gE.png";
          }else {
        return $clubRow['logo'];
      }
      }else if($type == 'nazwa'){

          return $clubRow['nazwa'];

      }else if($type == 'data_zalozenia'){
        return $clubRow['data_zalozenia'];
      }else if($type == 'liczba_zawodnikow'){
        return $clubRow['liczba_zawodnikow'];
      }else if($type == 'liga'){
        return $this->getLiga($clubRow['id_liga']);
      }
      } catch (Exception $e) {
          echo $e->getMessage();
      }
    }
    }

/**
 * Funkcja która dostaje id transferu i zwraca potrzebne informacje.
 */
    public function getId($id, $type){
        try {
          $q = $this->db->prepare("SELECT * FROM transfer WHERE id=:id");
          $q->execute(array(':id' => $id));
          $idRow = $q->fetch(PDO::FETCH_ASSOC);

          if($type == 'pilkarz'){
          return $idRow['id_pilkarz'];
        }else if($type == 'stary_klub'){
          return $idRow['id_klub'];
        }else if($type == 'nowy_klub'){
          return $idRow['id_nowy_klub'];
        }else if($type == 'kwota'){
          return $idRow['kwota'];
        }else if($type =='typ'){
          return $idRow['typ'];
        }else if($type == "proponowane_zarobki"){
          if($idRow['proponowane_zarobki'] == null || $idRow['proponowane_zarobki'] == '' ){
            return '<small>Brak informacji</small>';
          }else {
          return $idRow['proponowane_zarobki'];
        }
      }
        } catch (Exception $e) {
          echo $e->getMessage();
        }

    }
/**
 * Funkcja zwraca nam lige w której gra klub.
 * Input -> id_klub / OUTPUT -> Nazwa ligi.
 */
    public function getLiga($id){
      try {
        $q = $this->db->prepare("SELECT nazwa FROM liga WHERE id=:idLiga");
        $q->execute(array(':idLiga' => $id));
        $row = $q->fetch(PDO::FETCH_ASSOC);

        return $row['nazwa'];
      } catch (Exception $e) {
        echo $e->getMessage();
      }

    }


    public function sprawdzCzyTakiSam($id_zawodnik, $nowy_klub){

      try {
        //Pobieramy id klubu dla parametru $nowy_klub aby lepiej zweryfikowac dodawany transfer
        $q = $this->db->prepare("SELECT id FROM klub WHERE nazwa=:nazwa");
        $q->execute(array(':nazwa' => $nowy_klub));
        $row = $q->fetch(PDO::FETCH_ASSOC);

        $id_nowy_klub = $row['id'];
      } catch (Exception $e) {
        echo $e->getMessage();
      }

      try {
        $zapytanie = $this->db->query("SELECT * FROM transfer");

        foreach ($zapytanie as $wiersz) {
          if($wiersz['id_pilkarz'] == $id_zawodnik && $wiersz['id_nowy_klub'] == $id_nowy_klub){
            return true;
          }
          else {
            return false;
          }
        }

      } catch (Exception $e) {
        echo $e->getMessage();
      }


    }




    public function ileGlosow($id, $type){
      try {

        $q = $this->db->prepare("SELECT $type FROM glosowanie WHERE id_transfer = :id");
        $q->execute(array(':id' => $id));
        $row = $q->fetch(PDO::FETCH_ASSOC);

        return $row[$type];
      } catch (Exception $e) {
        echo $e->getMessage();
      }
}





/**
 * Funkcja Służy do usuwania transferu
 * Głównie dla administratora.
 */

    public function usunTransfer($id){
      try {

          $q = $this->db->prepare("DELETE FROM transfer WHERE id=:id");
          $q->execute(array(':id' => $id));
      } catch (Exception $e) {
        echo $e->getMessage();
      }

    }


    public function usunPilkarz($id){
      try {
        $q = $this->db->prepare("DELETE FROM pilkarz WHERE id=:id");
        $q->execute(array(':id'=> $id));
      } catch (Exception $e) {
        echo $e->getMessage();
      }

    }

    public function usunKlub($id){
      try {
        $q = $this->db->prepare("DELETE FROM klub WHERE id=:id");
        $q->execute(array(':id'=> $id));
      } catch (Exception $e) {
        $e->getMessage();
      }

    }






}





?>
