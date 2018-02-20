<?php
  session_start();

      $DB_host = "localhost";
      $DB_user = "root";
      $DB_pass = "";
      $DB_name = "transfery";

        try
        {
             $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
             $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
          catch(PDOException $e)
          {
               echo $e->getMessage();
          }


        include_once 'class.user.php';
        $user = new user($DB_con);
        include_once 'class.transfer.php';
        $transfer = new transfer($DB_con);
        include_once 'class.settings.php';
        $ustawienia = new settings($DB_con);



        /// DLA POLSKICH ZNAKÓW
        ///Dla całej bazy -> ALTER DATABASE databasename CHARACTER SET utf8 COLLATE utf8_unicode_ci;
        /// Dla pojedyńczych kolumn -> ALTER TABLE tablename CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
?>
