<?php
class settings{
  private $db;

  function __construct($DB_con)
  {
    $this->db = $DB_con;
  }

  /**
   * Włączenie / Wyłączenie komponenktu do dodawania ulubionych graczy, klubów itd.
   *  false = wyłączone.
   */
  private $ulubione = false; //Zmień na true aby włączyć komponent.
  private $waluta = "€";

  /**
   * Funkcja zwraca status $ulubione.
   */
  public function ulubione(){
    return $this->ulubione;
  }

  public function waluta(){
    return "€";
  }
}

?>
