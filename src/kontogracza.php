<?php
header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
  
session_start();
if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php');
  exit();
}

?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="/CSS/playeraccount.css" type="text/css">
  <title>Panel Gracza</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
   <!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = '27f47c7c5b7e6a55b613095010620dc4253810ad';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
</head>

<body>
<div class="container">
 <nav class="menu">
        <a href="/playerAccount/central" class="current">Nowy Widok Strony</a>
          <a href="/myteam/myTeamView" class="current">Moja Drużyna</a>
           
         <a href="/transfery">Transfery </a>
          <a href="/tabela/tit2">Tabele i Teminarz</a>
          <a href="http://menagoleague.pl/mail/MessagesView?recived=on">Poczta</a>
           <a href="rankingView">Ranking Graczy</a>
          <a href="pomoc.html" target="_blank">Pomoc</a>
          
          
          <a href="logout">Wyloguj</a>
          <a href="/admin/menu" target="_blank"> * </a>


  <?php
$idteams = $_SESSION['idteams'];


require_once"connect.php";
// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);
mysqli_query($conn,"SET CHARSET utf8");
mysqli_query($conn,"SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
// Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

  $newMessages = "SELECT * FROM mailbox where ToID=$idteams AND status=0";
$checkNewMessages = $conn->query($newMessages);
if ($checkNewMessages->num_rows > 0) {
    echo '<a href="http://menagoleague.pl/mail/MessagesView?recived=on"> Masz wiadomość!</a><br>';
}
//include"../playerAcount/playerAcountController.php";
//$playerAcountController = new PlayerAcountController();


date('d-m-Y H:i')."<br>";
echo '<br>';
echo $_SESSION['login']." - prezes klubu ".$_SESSION['teamname'];
echo "<br>ID klubu : ".$_SESSION['idteams']; 
echo "<br>GamerTag: ".$_SESSION['gamertag'];
echo "<br>E-mail: ".$_SESSION['email'];

//odwieczni rywale
  $eternalRivals = "SELECT * FROM eternal_rivals WHERE status is not null AND idteams=$idteams";
$getUserEternalRivals = $conn->query($eternalRivals);
if ($getUserEternalRivals->num_rows > 0) {
    echo '<br>Odwieczni Rywale:';
    while($rival = $getUserEternalRivals->fetch_assoc()) {
        echo $rival['rivalname'];
    }
} else {
   echo 'Odwieczni Rywale: Brak';
}

echo '<br>Morale zespołu:<a href="">100%</a><br>';


$nextGame = "select * from Terminarz
WHERE idteam1=$idteams AND g_1 is null
OR idteam2=$idteams AND g_1 is null
ORDER BY data ASC
LIMIT 1";

/*$getUserNextGame = $conn->query($nextGame);
if ($getUserNextGame->num_rows > 0) {
    echo '<br>Najbliższy przeciwnik: ';
    
    while($opponent = $getUserNextGame->fetch_assoc())
    {
        if($opponent['idteam1'] != $idteams) 
        {
        $next = $opponent['idteam1'];
        $nextOpponent = "SELECT * FROM teams WHERE idteams=$next";
        $getUserNextOpponent = $conn->query($nextOpponent);
            while($nextOpponent =$getUserNextOpponent->fetch_assoc())
            {
            echo $nextOpponent['teamname'];
            }
        
        } 
        else {
            $next = $opponent['idteam2'];
            $nextOpponent = "SELECT * FROM teams WHERE idteams=$next";
            $getUserNextOpponent = $conn->query($nextOpponent);
            while($nextOpponent =$getUserNextOpponent->fetch_assoc())
            {
            echo $nextOpponent['teamname'];
            }
        }

     echo "  (".  $opponent['data'].") Kolejka  ". $opponent['kolejka'].'(<a href="">Wpisz Wynik</a>)'.'(<a href="">Przełóż mecz</a>)';
    }
   
    

    
} else {
   echo 'Nie masz nadchodzących spotkań';
}
*/
echo '<br><br><a href="financesView.php">Finanse</a><br><br>';


$sql = "SELECT * FROM teams where idteams=$idteams";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc())
    {
        echo "Budżet klubu: " . $row["money"]." - Menagocoins <br>";
        $money =  $row["money"];
        $_SESSION['money'] = $money;
         $_SESSION['teamname'] = $row["teamname"];
        $team_name = $_SESSION['teamname']; 
        
        
        
    }
    }
 else {
    echo "0 results";
      }
      
      $sql2 = "SELECT SUM(kwota)
FROM oferty
WHERE id_k=$idteams
AND status!=1
AND status!=3";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
$row2 = $result->fetch_assoc();
echo "Zamrożone na transfery: " . $row2["SUM(kwota)"]." - Menagocoins <br>";
$_SESSION['SUM(kwota)'] = $row2["SUM(kwota)"];
$frozen = $_SESSION['SUM(kwota)'];
}
$result->free_result();

//pensja całej drużyny

$sql2= "SELECT SUM(pensja) AS pensjazespolu FROM players where idteams=$idteams";
$result12 = $conn->query($sql2);
if ($result12->num_rows > 0) {
    // output data of each row
    
    while($row = $result12->fetch_assoc()) {
    $pensjazespolu = $row["pensjazespolu"];
    $_SESSION['pensjazespolu']= $pensjazespolu;
        echo  "Pensja całego zespołu wynosi $pensjazespolu Menagocoins<br>";
    }
} else {
    echo "Wystąpił problem podczas wyliczania pensji";
    }

    //dla pewności ustawiamy pensję zespołu w bazie

$sql3 = "UPDATE teams SET pensjazespolu=$pensjazespolu WHERE idteams=$idteams";
$result3 = $conn->query($sql3);

//Na koniec zwalniamy rezultat
$result->free_result();

//Wyswietlamy ostatnie transfery
$sql4 = "SELECT * FROM oferty
JOIN players
ON oferty.idplayers=players.idplayers
 where status=1
 ORDER BY oferty.idoferty DESC
 LIMIT 10";
$result4 = $conn->query($sql4);

if ($result4->num_rows > 0) {
   echo '<table><tr><th>Zawodnik</th><th>Przeszedł do</th><th>Za kwotę</th></tr><br> <br>Ostatnie Transfery';
    while($row = $result4->fetch_assoc())
    {
      echo "<tr><td>: ".$row["playername"]. " </td><td> " . $row["team_k"]. " </td><td>" . $row["kwota"]. "</td></tr>";
        
        
        
    }
     echo '</table>';
    }
 else {
    echo "Brak transferów w aktualnym oknie transferowym";
      }

//Wyswietlamy informacje o zawieszeniach

$sql5 = "Select * From Stats
INNER JOIN players
ON Stats.idplayers=players.idplayers
 WHERE czerwone>0 AND idteams=$idteams
 ORDER BY DATA DESC, czerwone DESC
 ";
$result5 = $conn->query($sql5);

if ($result5->num_rows > 0) {
   echo '<table>';
    while($row = $result5->fetch_assoc())
    {
      echo "<tr><td> Twój zawodnik<b> ".$row["playername"]. "</b></td><td> Został zawieszony na najbliższy mecz ligowy Po wydaniu decyzji. Data wydania Decyzji <b>". $row["DATA"]. "</b></td></tr>";
        
        
        
    }
     echo '</table>';
    }
 else {
    echo " <b>Żaden z Twoich zawodników nie jest obecnie zawieszony</b>";
      }
$conn->close();

  ?>
  </div>
  </body>
    </html>
