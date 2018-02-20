<?php
  require_once 'class/DatabaseConnect.php';
  if($user->is_loggedin()!= ""){
    $user->redirect('index.php');
  }

    if(isset($_POST['logowanie'])){
        $nick = $_POST['login'];
        $password = $_POST['haslo'];

        if($user->login($nick, $password)){
          $user->redirect('index.php');
        }else{
          $error[] = "Podałeś błędne dane do logowania!";
        }
    }



  if(isset($_POST['register'])){
    $nick = trim($_POST['login']);
    $email = trim($_POST['email']);
    $password = trim($_POST['haslo']);
    $password2 = trim($_POST['powtorz_haslo']);

    if($nick=="") {
       $error[] = "Podaj login!";
    }
    else if($email=="") {
       $error[] = "Podaj email!";
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $error[] = 'Proszę podać poprawny adres email!';
    }
    else if($password=="") {
       $error[] = "Podaj hasło";
    }
    else if(strlen($password) < 6){
       $error[] = "Hasło musi mieć co najmniej 6 znaków";
    }else if($password != $password2) {
      $error[] = "Hasła muszą być takie same";
    }
    else
    {
       try
       {

          $stmt = $DB_con->prepare("SELECT nick,email FROM uzytkownicy WHERE nick=:nick OR email=:email");
          $stmt->execute(array(':nick' => $nick ,':email'=>$email));
          $row=$stmt->fetch(PDO::FETCH_ASSOC);

            if($row['nick'] == $nick){
              $error[] = "Podany login już istnieje w bazie danych!";
            }else if($row['email'] == $email){
              $error[] = "Podany adres email już istnieje w bazie danych!";
            }
            else{
              if($user->register($nick,$email,$password)){
                $user->redirect('Logowanie2.php?joined');
              }
            }


      } catch (PDOException $e) {
          echo $e->getMessage();
      }

    }

  }


?>

<!DOCTYPE html>
<html>
  <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="utf-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="css/login.css">

  </head>
  <body>


    <div class="container">
	<div class="row">
    <?php
      if(isset($error)){
        foreach ($error as $error) {
        ?>
            <div class="alert alert-danger">
              <?php echo $error; ?>
            </div>
        <?php
        }
      }else if(isset($_GET['joined']))
      {
        ?>
        <div class="alert alert-success">
          <span>Zarejestrowałeś się możesz się teraz zalogować!</span>
        </div>
        <?php
      }
    ?>

<!-- Mixins-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Logowanie do serwisu Transfery.co</h1>
</div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Logowanie</h1>
    <form method="post">
      <div class="input-container">
        <input type="text" id="Username" name="login" required="required"/>
        <label for="Username">Login</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="Password" name="haslo" required="required"/>
        <label for="Password">Hasło</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button type="submit" name="logowanie"><span>Zaloguj</span></button>
      </div>
      <div class="footer"><a href="#">Nie pamiętasz hasła?</a></div>
    </form>
  </div>



  <div class="card alt">
    <div class="toggle"></div>
    <h1 class="title">Rejestracja
      <div class="close"></div>
    </h1>
    <form method="post">
      <div class="input-container">
        <input type="text" id="Username" name="login" required="required"/>
        <label for="Username">Login</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="text" id="User" name="email" required="required"/>
        <label for="Email">Email</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="Password" name="haslo" required="required"/>
        <label for="Password">Hasło</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="Repeat Password" name="powtorz_haslo" required="required"/>
        <label for="Repeat Password">Powtórz Hasło</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button type="submit" name="register"><span>Dalej</span></button>
      </div>
    </form>
  </div>
</div>
<!-- Portfolio--><a id="portfolio" href="index.html" title="View my portfolio!">Home<i class="fa fa-link"></i></a>
	</div>
</div>


<script type="text/javascript">

      $(document).ready(function(){
      $('.toggle').on('click', function() {
      $('.container').stop().addClass('active');
      });

      $('.close').on('click', function() {
      $('.container').stop().removeClass('active');
      });

      });
</script>
  </body>
</html>
