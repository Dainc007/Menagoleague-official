<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
  header('Location: kontogracza.php');
  exit();
}
  
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
   <link rel="stylesheet" href="/CSS/index.css" type="text/css">
   <link rel="stylesheet" href="/ikonki/css/fontello.css" type="text/css">
  <meta charset="UTF-8" />
  <title> Menago League </title>
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


  <nav class="menu">
          
          <div class="opcja"><a href="rejestracja">Rejestracja</a></div>
          <div class="opcja"><a href="tabela/tit2">Tabele i Teminarz</a></div>
          <div class="opcja"><a href="rankingView">Ranking Graczy</a></div>
          <div class="opcja"><a href="pomoc.html">Pomoc</a></div>
          <div class="opcja"><a href="#contact">Kontakt</a></div>
 </nav>

  

<section class="splash">
  <div class="page-intro">
  	<div class="main-words">
	    <h1 class="main-title">Witamy w Menago League</h1>
	    <h2 class="main-subtitle">Zostań Menagerem - Przejmij istniejący klub lub rozpocznij przygodę z nową drużyną. </h2>
	    <div class="zaslona"></div>
	</div>
    <a class="btn btn-solid" href="#about">Dowiedz się więcej</a>

  </div>
  <div class="login">
    <form action="zaloguj.php" method="post">
    	<h4>Logowanie</h4>
      	<input type="text" name="login" placeholder="login" />
      	<input type="password" name="haslo" placeholder="hasło" />   	
	    <input type="submit" value="Zaloguj się" />	     
	     <a href="odnosnik do strony" class="zapomnialesHasla">Zapomniałeś hasła?</a>	 		  	
    </form>

   
      
      <?php
      if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
      ?>  
  </div>
</section>

<section class="about" id="about">
  <div class="container" id="intro">
    <h2 class="section-title">Na czym dokładnie polega tryb "Kariery Online" ?</h2>
    <p class="section-intro">Cała zabawa odbywa się przy użyciu gry FIFA na platformie Xbox One. To tam rozgrywane są mecze z przeciwnikami. Zapewne wielokrotnie miałeś do czynienia z trybem kariery w którejkolwiek z gier z serii FIFA. Dzięki tej stronie możesz urozmaicić grę w tym trybie, zamieniająć rywalizację z botem na konkurowanie z innymi graczami.
Na stronie przejmiesz stery w jednym z autentycznych klubów, skompletujesz pierwszy skład,  który z biegiem czasu ulepszysz nowymi transferami. W odpowiedniej sekcji na stronie sprawdzisz które Twój klub zajmuje miejsce w tabeli, z kim gra następny mecz, jakim dyspouje budżetem oraz jakie są oczekiwania zarządu na ten sezon. Zainteresowany? </p>
  </div>
</section>

<section class="features">
  <div class="container">
    <h2 class="section-title">Co musisz wiedzieć, zanim zaczniesz zabawę?</h2>
    <div class="features-wrapper">
      <article class="feature">
        <i class="far fa-futbol"></i>
        <i class="icon-window"></i>
        <h3 class="feature-title">Do czego służy strona?</h3>

        <p class="feature-description">Na stronie będziesz mógł zarządzać swoim klubem: Przeprowdzać transfery, sprawdzać terminarz, komunikować się z przeciwnikami i wiele, wiele innych.</p>
      </article>
       <article class="feature">
        <i class="far fa-futbol"></i>
        <i class="icon-soccer-ball"></i>
        <h3 class="feature-title">Jak mogę zagrać mecz?</h3>
        <p class="feature-description">Aby zagrać mecz w pierwszej kolejności musisz przenieść swoich zawodników ze strony Menago League do konkretnej drużyny już bezpośrednio w grze FIFA na konsoli. Zajmie Ci to jednorazowo około 15 minut. Pełny poradnik jak to zrobić znajdziesz tutaj.</p>
      </article>
      <article class="feature">
        <i class="far fa-futbol"></i>
        <i class="icon-lightbulb"></i>
        <h3 class="feature-title">Co jeszcze powinienem zrobić?</h3>
        <p class="feature-description">Przede wszystkim zapoznaj się z regulaminem. Złamanie któregokolwiek z punktu regulaminu może doprowadzić do konieczności powtórzenia meczu, bądź walkowera na Twoją niekorzyść. Pełny regulamin, czyli jak przygotować się do meczu oraz jak nagrać raport po zakończeniu spotkania - znajdziesz pod TYM linkiem</p>
      </article>
    </div>
  </div>
</section>

<!--<section class="about2" id="about2">
  <div class="container">
    <h2 class="section-title"></h2>
    <p class="section-intro"></p>
  </div>
</section>-->

<section class="statement" id="statement">
  <div class="container">
    
 </div>
 </section>

<section class="gallery" id="gallery">
                                     <h2 class="section-title"> Menago Galeria </h2>
                                                             <div class="gallery-wrapper">
 <figure class="gallery-item">
<img src="https://i.postimg.cc/DZm3FDgv/Snaggy-Dainc-EASPORTSFIFA20-20200119-11-31-00.png" alt="image">
                                                                                                      </figure>
 <figure class="gallery-item">
<img src="https://i.postimg.cc/DZm3FDgv/Snaggy-Dainc-EASPORTSFIFA20-20200119-11-31-00.png" alt="image">
                                                                                                      </figure>
 <figure class="gallery-item">
<img src="https://i.postimg.cc/DZm3FDgv/Snaggy-Dainc-EASPORTSFIFA20-20200119-11-31-00.png" alt="image">
                                                                                                      </figure>
 <figure class="gallery-item">
<img src="https://i.postimg.cc/DZm3FDgv/Snaggy-Dainc-EASPORTSFIFA20-20200119-11-31-00.png" alt="image">
                                                                                                      </figure>
</div>
  </section>


<section class="contact" id="contact">
  <div class="container">
    <h2 class="section-title"> Kontakt </h2>
<ul class="social-links">
  <li>
<a href="https://www.facebook.com/MenagoLeague/?view_public_for=224255515024918" target="_blank">Fb</a>
<li>
<a href="https://www.facebook.com/MenagoLeague/?view_public_for=224255515024918" target="_blank">Gr</a></li>
<li>
<a href="https://www.facebook.com/MenagoLeague/?view_public_for=224255515024918" target="_blank">Wk</a></li>
<li>
<a href="https://www.facebook.com/danielvandaniel" target="_blank">Adm</a></li>
    </ul>
 </div>
 </section>
</body>

<footer class="page-footer">
<div class="container"
     <p>© Stworzone przez Daniel Heinze </p>
<p>  ♥ wraz z zespołem <a href="https://www.facebook.com/MenagoLeague/?view_public_for=224255515024918" target="_blank">Menago League</a></p>
     </div>
</footer>

<script type="text/javascript">
	ustawMargines();
	window.onresize=ustawMargines;
	function ustawMargines()
	{
		var pierwszySection=document.getElementsByClassName('splash')[0];
	pierwszySection.style.marginTop=document.getElementsByClassName("menu")[0].offsetHeight+"px";
	}

</script>

</html>