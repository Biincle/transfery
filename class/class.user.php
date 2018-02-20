<?php
 class user{
   private $db;

   function __construct($DB_con)
   {
     $this->db = $DB_con;
   }


   public function register($login, $email, $password1){
     try {
     $nowe_haslo = password_hash($password1, PASSWORD_DEFAULT); // Hashujemy hasło...

      $stm = $this->db->prepare("INSERT INTO uzytkownicy VALUES(NULL, :nick, :haslo, :email, :uprawnienia)");
      $stm->bindValue(":nick", $login);
      $stm->bindValue(":haslo", $nowe_haslo);
      $stm->bindValue(":email", $email);
      $stm->bindValue(":uprawnienia", "normal");

      $stm->execute();

      return $stm;
    }
      catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }


   public function login($login,$password)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM uzytkownicy WHERE nick=:nick LIMIT 1");
          $stmt->execute(array(':nick'=>$login));

          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($password, $userRow['haslo']))
             {
                $_SESSION['user_session'] = $userRow['id'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }


   public function redirect($url)
    {
        header("Location: $url");
    }


    public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }


   public function dane($id, $type){
     try {
       $q = $this->db->prepare("SELECT * FROM uzytkownicy WHERE id=:id");
       $q->execute(array(':id'=>$id));
       $row = $q->fetch(PDO::FETCH_ASSOC);

       return $row[$type];
     } catch (Exception $e) {
       echo $e->getMessage();
     }

   }

   public function czy_ulubione($user_id){
     try {
       $stmt = $this->db->prepare("SELECT * FROM ulubione WHERE id_uzytkownika=:id LIMIT 1");
       $stmt->execute(array(':id'=>$user_id));

       $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

       if($userRow['u_pilkarz'] == "" || $userRow['u_klub'] == "" || $userRow['u_liga'] == ""){
         return false;
       }else {
         return true;
       }

     } catch (Exception $e) {
       echo $e->getMessage();
     }

   }

   public function dodaj_ulubione($user_id, $pilkarz, $klub, $liga){
     try {
       $stm = $this->db->prepare("INSERT INTO ulubione VALUES(NULL, :id_uzytkownika, :u_pilkarz, :u_klub, :u_liga)");
       $stm->bindValue(":id_uzytkownika", $user_id);
       $stm->bindValue(":u_pilkarz", $pilkarz);
       $stm->bindValue(":u_klub", $klub);
       $stm->bindValue(":u_liga", $liga);

       $stm->execute();

       return $stm;
     } catch (Exception $e) {

     }

   }

 }


?>
