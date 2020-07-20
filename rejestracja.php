<?php
session_start();

if(isset($_POST['email']))
{
  //udana walidacja? Zalozmy, ze tak!
  $wszystko_OK=true;

  //sprawdzam poprawnosc loginu, czy nie jest zajety.
  $login = $_POST['login'];

  //Dlugosc loginu
  if ((strlen($login)<3) || (strlen($login)>40))
  {
    $wszystko_OK=false;
    $_SESSION['e_login']="login musi posiadac od 3 do 40 znakow";
  }

  if (ctype_alnum($login)==false)
  {
    $wszystko_OK=false;
    $_SESSION['e_login']="Login moze skladac sie tylko z liter i cyfr, bez polskich znakow";
  }
  //Sprawdzamy poprawnosc emaila
  $email = $_POST['email'];
  $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

  if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) ||($emailB!=$email))
  {
    $wszystko_OK=false;
    $_SESSION['e_email']="Podaj poprawny adres e-mail";
  }
  //sprawdzamy czy haslo jest poprawne
  $haslo = $_POST['haslo'];
  $haslo2 = $_POST['haslo2'];

  if($haslo!=$haslo2)
  {
    $wszystko_OK=false;
    $_SESSION['e_haslo']="Hasła nie są takie same";
  }

  $haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);

  //Dodajemy Gamertag

  $gamertag = $_POST['gamertag'];

  //czy zaakceptowano regulamin?
  if (!isset($_POST['regulamin']))
  {
    $wszystko_OK=false;
    $_SESSION['e_haslo']="Prosimy o zaakceptowanie regulaminu. Zalecamy zapoznanie sie z regulaminem.";
  }

require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

try
  {
  $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
  if($polaczenie->connect_errno!=0)
  {
    throw new Exception(mysqli_connect_errno());
  }
  else
  {
    //Czy email juz istnieje?
    $rezultat =  $polaczenie->query("SELECT iduzytkownicy FROM uzytkownicy WHERE email='$email'");

    if (!$rezultat) throw new Exception($polaczenie->error);

    $ile_takich_maili = $rezultat->num_rows;
    if($ile_takich_maili>0)
    {
      $wszystko_OK=false;
      $_SESSION['e_email']="Istnieje juz konto o podanym adresie mailowym";
    }

    //Czy login juz istnieje?
    $rezultat =  $polaczenie->query("SELECT iduzytkownicy FROM uzytkownicy WHERE login='$login'");

    if (!$rezultat) throw new Exception($polaczenie->error);

    $ile_takich_loginow = $rezultat->num_rows;
    if($ile_takich_loginow>0)
    {
      $wszystko_OK=false;
      $_SESSION['e_login']="Istnieje juz konto o podanym loginie";
    }

    if($wszystko_OK==true)
    {
      //Testy zaliczone, mozemy dodac uzytkownika do bazy danych
  if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$login','$haslo_hash','$email','$gamertag',NULL)"))
  {
    $_SESSION['udanarejestracja']=true;
    header('Location: witamy.php');
  }
  else
  {
    throw new Exception($polaczenie->error);
  }
    }

    $polaczenie->close();
  }
}
catch(Exception $e)
{
  echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
}
}

?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <title>Rejestracja</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="description" content="blablabla" />
    <meta name="keywords" content="blablabla" />

    <!-- Normalize file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" 
    integrity="sha256-l85OmPOjvil/SOvVt3HnSSjzF1TUMyT9eV0c2BzEGzU=" crossorigin="anonymous">
    
    <!-- Login and password css file -->
    <link rel="stylesheet" href="/CSS/registercss.css">
</head>

<body>
    <section class="container">
        <a href="index.php" class="register__logo-link"> 
            <img src="/CSS/pictures/logo.png" alt="Logo strony" class="register__logo-image">
        </a>        
        <div class="register-container">
            <h3 class="register-container__header">
                Rejestracja
            </h3>
  <form method="post">
<div class="input-container input-effect-container">
  <input type="text" name="login" value="" placeholder="Nazwa użytkownika"> <br>
  </div>
<?php

if(isset($_SESSION['e_login']))
{
  echo '<div class="error">'.$_SESSION['e_login'].'</div>';
  unset($_SESSION['e_login']);
}

?>
<div class="input-container input-effect-container">
  <input type="password" name="haslo" value=""placeholder="Hasło"> <br>
  </div>
  <div class="input-container input-effect-container">
  <input type="password" name="haslo2" value="" placeholder="Powtórz Hasło"><br>
  </div>
<div class="input-container input-effect-container">
  <input type="text" name="email" value=""placeholder="adres e-mail"> <br>
  </div>

  <?php

  if(isset($_SESSION['e_email']))
  {
    echo '<div class="error">'.$_SESSION['e_email'].'</div>';
    unset($_SESSION['e_email']);
  }

  ?>
<div class="input-container input-effect-container">
  <input type="text" name="gamertag" value="" placeholder="GamerTag">  <br>
  </div>
  <div class="input-container">
  <input type="checkbox" name="regulamin"> Akceptuje <a href="/regulamin.html" target="_blank"> Regulamin </a><br>
  </div>

  <?php

  if(isset($_SESSION['e_regulamin']))
  {
    echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
    unset($_SESSION['e_regulamin']);
  }

  ?>
<div class="register-button">
<input type="submit" value="Zakładam Konto" />
</div>
<div class="register__last-sentence">
                    <a href="login.php" class="register__last-sentence-link">
                    <img src="/CSS/pictures/outdoor.png" class="register__last-sentence-image" alt="Drzwi" />
                    </a>
                </div>

  </form>
   </div>
    </section>

  <body>
    </html>