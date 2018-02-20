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
              //$user->redirect('login.php?joined');
              $user->redirect('reg.php?name='.$nick.'&mail='.$email);
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
    <meta charset="utf-8">
       <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
       <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
       <!-- <link rel="stylesheet" href="css/bootstrap.min.css">
       <link rel="stylesheet" href="css/bootstrap-material-design.min.css"> -->
    <title>Logowanie do serwisu</title>
  </head>
  <body>
<header>
  TransferyPilkarskie.pl
</header>
<div class="col-md-12">

<div class="login" id="login">
<i ripple>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
<path fill="#C7C7C7" d="m12,2c-5.52,0-10,4.48-10,10s4.48,10,10,10,10-4.48,10-10-4.48-10-10-10zm1,17h-2v-2h2zm2.07-7.75-0.9,0.92c-0.411277,0.329613-0.918558,0.542566-1.20218,1.03749-0.08045,0.14038-0.189078,0.293598-0.187645,0.470854,0.02236,2.76567,0.03004-0.166108,0.07573,1.85002l-1.80787,0.04803-0.04803-1.0764c-0.02822-0.632307-0.377947-1.42259,1.17-2.83l1.24-1.26c0.37-0.36,0.59-0.86,0.59-1.41,0-1.1-0.9-2-2-2s-2,0.9-2,2h-2c0-2.21,1.79-4,4-4s4,1.79,4,4c0,0.88-0.36,1.68-0.930005,2.25z"/>
</svg>
</i>
<div class="photo">
</div>
<span>Zaloguj się do serwisu</span>
<?php
  if(isset($error)){
    foreach ($error as $error) {
    ?>
    <div id="card-alert" class="card red">
      <div class="card-content white-text">
      <p><?php echo $error;?></p>
      </div>
    </div>
    <?php
    }
  }
?>
<form id="login-form" method="post">
<div id="u" class="form-group">
  <input id="username" spellcheck=false class="form-control" name="login" type="text" size="18" alt="login" required="">
  <span class="form-highlight"></span>
  <span class="form-bar"></span>
  <label for="username" class="float-label">Login</label>
  <erroru>
  	Musisz podać login!
  	<i>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
		    <path d="M0 0h24v24h-24z" fill="none"/>
		    <path d="M1 21h22l-11-19-11 19zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
		</svg>
  	</i>
  </erroru>
</div>
<div id="p" class="form-group">
  <input id="password" class="form-control" spellcheck=false name="haslo" type="password" size="18" alt="haslo" required="">
  <span class="form-highlight"></span>
  <span class="form-bar"></span>
  <label for="password" class="float-label">Hasło</label>
  <errorp>
  	Hasło jest wymagane!
  	<i>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
		    <path d="M0 0h24v24h-24z" fill="none"/>
		    <path d="M1 21h22l-11-19-11 19zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
		</svg>
  	</i>
  </errorp>
</div>

<button type="submit" name="logowanie" ripple>Zaloguj</button>
</form>
<footer><a href="#0" class="createAcc">Stwórz konto</a></footer>
</div>





<!-- Rejestracja w serwisie -->

<div class="login register" id="register" style="display:none;">
<i ripple>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
<path fill="#C7C7C7" d="m12,2c-5.52,0-10,4.48-10,10s4.48,10,10,10,10-4.48,10-10-4.48-10-10-10zm1,17h-2v-2h2zm2.07-7.75-0.9,0.92c-0.411277,0.329613-0.918558,0.542566-1.20218,1.03749-0.08045,0.14038-0.189078,0.293598-0.187645,0.470854,0.02236,2.76567,0.03004-0.166108,0.07573,1.85002l-1.80787,0.04803-0.04803-1.0764c-0.02822-0.632307-0.377947-1.42259,1.17-2.83l1.24-1.26c0.37-0.36,0.59-0.86,0.59-1.41,0-1.1-0.9-2-2-2s-2,0.9-2,2h-2c0-2.21,1.79-4,4-4s4,1.79,4,4c0,0.88-0.36,1.68-0.930005,2.25z"/>
</svg>
</i>
<div class="photo">
</div>
<span>Tworzenie konta</span>
<form id="login-form" method="post">
<div id="u" class="form-group">
  <input id="username" spellcheck=false class="form-control" name="login" type="text" size="18" alt="login" required="">
  <span class="form-highlight"></span>
  <span class="form-bar"></span>
  <label for="username" class="float-label">Login</label>
  <erroru>
  	Musisz podać poprawy login!
  	<i>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
		    <path d="M0 0h24v24h-24z" fill="none"/>
		    <path d="M1 21h22l-11-19-11 19zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
		</svg>
  	</i>
  </erroru>
</div>
<div id="u" class="form-group">
  <input id="username" spellcheck=false class="form-control" name="email" type="text" size="18" alt="login" required="">
  <span class="form-highlight"></span>
  <span class="form-bar"></span>
  <label for="username" class="float-label">Email</label>
  <erroru>
  	Musisz podać poprawny e-mail!
  	<i>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
		    <path d="M0 0h24v24h-24z" fill="none"/>
		    <path d="M1 21h22l-11-19-11 19zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
		</svg>
  	</i>
  </erroru>
</div>
<div id="p" class="form-group">
  <input id="password" class="form-control" spellcheck=false name="haslo" type="password" size="18" alt="login" required="">
  <span class="form-highlight"></span>
  <span class="form-bar"></span>
  <label for="password" class="float-label">Hasło</label>
  <errorp>
  	Hasło jest wymagane!
  	<i>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
		    <path d="M0 0h24v24h-24z" fill="none"/>
		    <path d="M1 21h22l-11-19-11 19zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
		</svg>
  	</i>
  </errorp>
</div>
<div id="p" class="form-group">
  <input id="password" class="form-control" spellcheck=false name="powtorz_haslo" type="password" size="18" alt="login" required="">
  <span class="form-highlight"></span>
  <span class="form-bar"></span>
  <label for="password" class="float-label">Potwierdź hasło</label>
  <errorp>
  	Musisz potwierdzić hasło!
  	<i>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
		    <path d="M0 0h24v24h-24z" fill="none"/>
		    <path d="M1 21h22l-11-19-11 19zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
		</svg>
  	</i>
  </errorp>
</div>
<div class="form-group">
<!-- <input type="checkbox" id="rem">
<label for="rem">Stay Signed in</label> -->
<button type="submit" name="register" ripple>Zarejestruj</button>
</div>
</form>
<footer><a href="#0" class="loginAcc">Masz już konto? Zaloguj się</a></footer>
</div>

<p class="copyright">
	<span>  © 2017 Copyright: <a href="#"> Paweł Ciarka & Mateusz Pylak </a></span>
</p>
</div>
</body>
</html>
<style media="screen">
/*http://drbl.in/nYHu*/

/*
Author : Himateja
Editor : Codepen
Permissions : Open Source
*/

*,
*:after,
*:before
{
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  -ms-box-sizing: border-box;
  -o-box-sizing: border-box;
  box-sizing: border-box;
  padding: 0;
  margin: 0;
}

html, body
{
position: absolute;
height: 100%;
width: 100%;
background: rgb(243, 243, 243);
color: rgba(0,0,0,0.6);
font-family: Roboto,Helvetica,Arial,sans-serif;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
-o-user-select: none;
user-select: none;
}

body header {
position: relative;
width: 100%;
height: 80px;
box-shadow: 0 2px 5px 0 rgba(0,0,0,0.26);
/* background: rgb(3, 169, 245);*/
background-color: #2ecc71;
font-size: 30px;
font-weight: 300;
color: rgb(242, 251, 253);
text-align: center;
line-height: 75px;
}
/*
CARD ALERT by biincle

*/

.card {
    overflow: hidden;
}
.card {
    position: relative;
    margin: 1rem 0 1rem 0;
    background-color: #fff;
    transition: box-shadow .25s;
    border-radius: 2px;
    opacity: 0.8;
}
.red {
    background-color: #F44336 !important;
}
.card .card-content {
    padding: 10px;
    border-radius: 0 0 2px 2px;
}
.white-text {
    color: #fff !important;
}
.card .card-content p {
    margin: 0;
    color: inherit;
}

/*
 ----CARD ALERT---
*/
.login {
position: relative;
  padding: 10px;
  margin: 40px auto 80px auto;
  width: 400px;
  height: 460px;
  border-radius: 3px;
  background: white;
  box-shadow: 0 1px 5px 0 rgba(0,0,0,0.26);
  overflow: hidden;
}
.register {
  height: 560px;
}

.login > i {
position: relative;
width: 20px;
height: 20px;
border-radius: 50%;
float: right;
cursor: pointer;
}

.login .photo {
position: relative;
width: 100px;
height: 100px;
margin: 30px 135px;
border-radius: 50%;
background: rgb(223, 223, 223);
border: 13px solid rgb(223, 223, 223);
overflow: hidden !important;
transform: rotate(-1deg);
}

.login .photo:before {
position: absolute;
content: '';
width: 35px;
height: 35px;
top: 0px;
right: 20px;
border-radius: 50%;
background: #aaa;
border: 2px solid #fff;
transform: scale(0);
transition: 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
-webkit-animation: user-head 0.5s 0s forwards;
-moz-animation: user-head 0.5s 0s forwards;
animation: user-head 0.5s 0s forwards;
}

.login .photo:after {
position: absolute;
content: '';
width: 140px;
height: 220px;
top: 38px;
right: -32px;
border-radius: 50%;
background: #aaa;
border: 2px solid #fff;
transform: translateY(36px);
transition: 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
-webkit-animation: user-body 0.5s 0.3s forwards;
-moz-animation: user-body 0.5s 0.3s forwards;
animation: user-body 0.5s 0.3s forwards;
}

.login > span {
display: block;
text-align: center;
margin: -15px 0;
font-size: 15px;
}

form {
position: relative;
width: 350px;
margin: 50px 15px;
}

.form-group {
position: relative;
margin-top: 35px;
margin-bottom: 20px;
}

.form-control {
display: block;
height: 36px;
width: 100%;
border: none;
border-radius: 0 !important;
font-size: 15px;
font-family: inherit;
font-weight: 300;
padding: 0;
background-color: transparent;
box-shadow: none;
border-bottom: 1px solid rgba(117, 117, 117, 0.15);
}

.form-control:focus {
border-bottom: 2px solid rgb(3, 169, 245);
outline: none;
box-shadow: none;
}

.form-highlight {
position: absolute;
height: 60%;
width: 60px;
top: 25%;
left: 0;
pointer-events: none;
opacity: 0.4;
}

.form-control:focus ~ .form-highlight {
-webkit-animation: inputHighlighter 0.3s ease;
-moz-animation: inputHighlighter 0.3s ease;
animation: inputHighlighter 0.3s ease;
}

.float-label {
position: absolute;
left: 0;
top: 10px;
font-size: 16px;
color: #999;
font-weight: 300;
transition: 0.2s ease all;
-moz-transition: 0.2s ease all;
-webkit-transition: 0.2s ease all;
}

.form-control:focus ~ .float-label, .form-control:valid ~ .float-label {
top: -15px;
font-size: 12px;
}

.form-group erroru, .form-group errorp {
position: absolute;
width: 100%;
left: 0;
top: 38px;
font-size: 11px;
color: #d34336;
font-weight: 300;
transition: 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55) all;
-moz-transition: 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55) all;
-webkit-transition: 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55) all;
opacity: 0;
}

.form-group erroru i,.form-group errorp i {
position: absolute;
right: 0;
width: 15px;
height: 15px;
border-radius: 50%;
float: right;
}

.form-group erroru i svg, .form-group errorp i svg {
fill:#d34336;
}

.form-group[errr] .float-label {
color: #d34336 !important;
}

.form-group[errr] .form-control {
border-bottom: 1px solid #d34336 !important;
}

.form-group[errr] .form-control:focus {
border-bottom: 2px solid #d34336 !important;
}


.form-group[errr] erroru, .form-group[errr] errorp  {
opacity: 1;
}

input[type=checkbox]
{
  display: none;
  visibility: hidden;
}

input[type="checkbox"] + label
{
  cursor: pointer;
  font-size: 15px;
  font-weight: 500;
  transition: border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
}

input[type="checkbox"] + label:before
{
  display: inline-block;
  content: "";
  margin: 0 15px 3px 0px;
  width: 18px;
  height: 18px;
  background-color: #fff;
  border: 2px solid #5a5a5a;
  border-radius: 2px;
  vertical-align: middle;
}

input[type=checkbox]:checked + label:before
{
  background-image: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjIwcHgiIGhlaWdodD0iMTVweCIgdmlld0JveD0iMCAwIDIwIDE1Ij4NCjxwb2x5Z29uIGZpbGw9IiNGRkZGRkYiIHBvaW50cz0iNy4xNDMsMTQuOTM4IDAsNy43OTYgMi4wMjEsNS43NzYgNy4xNDMsMTAuODk4IDE3Ljk3OSwwLjA2MiAyMCwyLjA4MiAiLz4NCjwvc3ZnPg0K');
  background-color: rgb(3, 169, 245);
  border-color: rgb(3, 169, 245);
  background-repeat: no-repeat;
  background-position: 50% 50%;
  -webkit-background-size: 11px auto;
  -moz-background-size: 11px auto;
  -o-background-size: 11px auto;
  background-size: 11px auto;
}

button[type="submit"] {
position: relative;
float: right;
font-family: inherit;
font-weight: 100;
font-size: 15px;
border: 0;
margin: -3px 0px;
padding: 5px 15px;
border-radius: 3px;
cursor: pointer;
background: rgb(3, 169, 245);
color: #fff;
box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.37);
}

button[type="submit"]:focus {
outline: none;
}

footer {
position: absolute;
bottom: 0;
width: 100%;
height: 30px;
margin-left: -10px;
line-height: 29px;
text-align: center;
cursor: pointer;
border-top: 1px solid rgba(117, 117, 117, 0.15);
}

footer a {
display: block;
text-decoration: none;
font-size: 12px;
color: inherit;
}

footer a:hover {
color: rgba(0,0,0,0.9);
text-decoration: underline;
}

footer a:focus {
outline: none;
}

.copyright {
position: fixed;
width: 100%;
bottom: 5px;
text-align: center;
font-size: 12px;
}

.copyright a {
text-decoration: none;
color: rgb(3, 169, 245);
}

.copyright a:hover {
transition: none;
border-bottom: 1px solid rgb(3, 169, 245);
}

/* -- highlighter animation --------------------------- */
@-webkit-keyframes inputHighlighter {
from { background:#5264AE; }
to { width:0; background:transparent; }
}
@-moz-keyframes inputHighlighter {
from { background:#5264AE; }
to { width:0; background:transparent; }
}
@keyframes inputHighlighter {
from { background:#5264AE; }
to { width:0; background:transparent; }
}

@-webkit-keyframes user-head {
100% {
-webkit-transform:scale(1);
transform:scale(1);
-moz-transform:scale(1);
} }
@-moz-keyframes user-head {
100% {
-webkit-transform:scale(1);
transform:scale(1);
-moz-transform:scale(1);
} }
@keyframes user-head {
100% {
-webkit-transform:scale(1);
transform:scale(1);
-moz-transform:scale(1);
} }

@-webkit-keyframes user-body {
100% {
-webkit-transform:translateY(2px);
transform:translateY(2px);
-moz-transform:translateY(2px);
} }
@-moz-keyframes user-body {
100% {
-webkit-transform:translateY(2px);
transform:translateY(2px);
-moz-transform:translateY(2px);
} }
@keyframes user-body {
100% {
-webkit-transform:translateY(2px);
transform:translateY(2px);
-moz-transform:translateY(2px);
} }

[ripple] {
position: relative;
overflow: hidden;
-webkit-transition: box-shadow .4s;
-moz-transition: box-shadow .4s;
-ms-transition: box-shadow .4s;
-o-transition: box-shadow .4s;
transition: box-shadow .4s;
cursor: inherit;
}

[ripple] .touch {
background: rgba(255, 255, 255, 0.3);
pointer-events: none;
border-radius: 100%;
}
</style>
<script type="text/javascript">
// button ripple effect from @ShawnSauce 's pen https://codepen.io/ShawnSauce/full/huLEH
$(document).ready(function() {
$(function(){

var animationLibrary = 'animate';

$.easing.easeOutQuart = function (x, t, b, c, d) {
  return -c * ((t=t/d-1)*t*t*t - 1) + b;
};
$('[ripple]:not([disabled],.disabled)')
.on('mousedown', function( e ){

  var button = $(this);
  var touch = $('<touch><touch/>');
  var size = button.outerWidth() * 1.8;
  var complete = false;

  $(document)
  .on('mouseup',function(){
    var a = {
      'opacity': '0'
    };
    if( complete === true ){
      size = size * 1.33;
      $.extend(a, {
        'height': size + 'px',
        'width': size + 'px',
        'margin-top': -(size)/2 + 'px',
        'margin-left': -(size)/2 + 'px'
      });
    }

    touch
    [animationLibrary](a, {
      duration: 500,
      complete: function(){touch.remove();},
      easing: 'swing'
    });
  });

  touch
  .addClass( 'touch' )
  .css({
    'position': 'absolute',
    'top': e.pageY-button.offset().top + 'px',
    'left': e.pageX-button.offset().left + 'px',
    'width': '0',
    'height': '0'
  });

  /* IE8 will not appendChild */
  button.get(0).appendChild(touch.get(0));

  touch
  [animationLibrary]({
    'height': size + 'px',
    'width': size + 'px',
    'margin-top': -(size)/2 + 'px',
    'margin-left': -(size)/2 + 'px'
  }, {
    queue: false,
    duration: 500,
    'easing': 'easeOutQuart',
    'complete': function(){
      complete = true
    }
  });
});
});



$('.createAcc').click(function(){
  $("#login").css({ display: "none" });
  $("#register").css({display: "block"});
});
$('.loginAcc').click(function(){
  $("#register").css({ display: "none"});
  $("#login").css({ display: "block"});
});

var username = $('#username'),
  password = $('#password'),
  erroru = $('erroru'),
  errorp = $('errorp'),
  submit = $('#submit'),
  udiv = $('#u'),
  pdiv = $('#p');

username.blur(function() {
if (username.val() == '') {
  udiv.attr('errr','');
} else {
  udiv.removeAttr('errr');
}
});

password.blur(function() {
if(password.val() == '') {
  pdiv.attr('errr','');
} else {
  pdiv.removeAttr('errr');
}
});

submit.on('click', function(event) {
event.preventDefault();
if (username.val() == '') {
  udiv.attr('errr','');
} else {
  udiv.removeAttr('errr');
}
if(password.val() == '') {
  pdiv.attr('errr','');
} else {
  pdiv.removeAttr('errr');
}
});
});

</script>
