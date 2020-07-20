<?php

session_start();

if (!isset($_SESSION['udanarejestracja']))
{
  header('Location: index.php');
  exit();
}
else
{
  unset($_SESSION['udanarejestracja']);
}

?>
</html>
<body>

Dziękujemy za rejestrację w serwisie <br>
 <br> Możesz się <a href="index.php">zalogować!</a> <br><br>
Nie zapomnij dołączyć do naszej
<a href="https://www.facebook.com/groups/230246767524306/?ref=bookmarks">grupy</a>
na facebooku. <br> <br>
W kolejnym kroku, polecamy zajrzeć do <a href="/pomoc.html">SAMOUCZKA (link)</a>.<br>
Dzięki niemu dowiesz się jak poprawnie zbudować swoją drużynę, przeprowadzić transfer, kupić paczkę, nagrać raport po meczu i (w razie potrzeby) w trakcie spotkania. <br>
Za ukończenie samouczka, często przyznawane są nagrody. <br>
 <br> <br>
Zanim zagrasz pierwszy mecz, nie zapomnij zajrzeć do regulaminu <a href="/regulamin.html">(link TUTAJ)</a>. To pozwoli Ci uniknąć przegranych walkowerem.<br>
W razie potrzeby, więcej pomocy znajdziesz w naszej grupie na facebooku - <a href="https://www.facebook.com/groups/230246767524306/?ref=bookmarks">Menago League</a> <br> <br>
Zapraszamy również do polubienia naszej <a href="https://www.facebook.com/MenagoLeague/?eid=ARCV0BFmUzKq7LKuOkINBHlyU7844MUBW11pfBOsotZoNi55YM4U0Hw6cKOpVFdyoWrHsE3C4VZx0rhC">Strony</a> na facebooku. Będziemy na niej na bieżąco informować o nadchodzących zmianach i ulepszeniach serwisu, oraz do klubu na Xboxie o tej samej nazwie, gdzie będziemy przeprowadzać konkursy na najładniejsze bramki w sezonie, a także umożliwiamy szybkie znalezienie dostępnego sparing-partnera.
</body>
</html>
