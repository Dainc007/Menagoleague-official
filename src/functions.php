<?php
function connectDatabase()
 {
  $conn = new mysqli($host, $db_user, $db_password, $db_name);
  mysqli_query($conn,"SET CHARSET utf8");
  mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    };
}

function checkLogged()
{
  if (!isset($_SESSION['zalogowany']))
  {
    header('Location: index.php');
    exit();
  };
}

function wyswietlTekst()
{
  echo "działa";
  ;
}

function setHedders()
    {
 header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header('Content-Type: text/html; charset=UTF-8');
    }

function checkIfAdmin()
    {
        if ($_SESSION['idteams'] !=1)
        {  
echo "Nie masz uprawnień by tu być!";
  exit();
        }
    }
