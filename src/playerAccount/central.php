<?php
require_once"playerAccountController.php";
require_once"checkUser.php";

$idteams = $_SESSION['idteams'];
$gamertag = $_SESSION['gamertag'];
//Ustawiłem zmienną lig na 0, ponieważ wyrzuca błąd jeśli gracz nie zagrał jeszcze meczu w żadnych rozgrywkach(jego drużyna jest nowa).
//Zmienna lig w wersie 25 zostaje na nowo pobrana.

$lig =0;

$checkUser = new CheckUser();
$setHedders = $checkUser->setHedders();
$checkIfUserIsLogged = $checkUser->checkIfUserIsLogged();
$checkifMoneyIsSet = $checkUser->checkIfMoneyIsSet();
$checkifUserHasTeam = $checkUser->checkIfUserHasTeam($idteams);

$playerAccountController = new playerAccountController();

$getLastTransfers = $playerAccountController->getLastTransfers();

$getUserLeague = $playerAccountController->getUserLeague($idteams);
    foreach($getUserLeague as $row)
    {
       $lig = $row['lig'];
    }

$getUserLeagueTable = $playerAccountController->getUserLeagueTable($lig);
$getUserLeagueTopScorer = $playerAccountController->getUserLeagueTopScorer($lig);

$getUserLeagueTopAsistants = $playerAccountController->getUserLeagueTopAsistants($lig);

$getUserNextGame = $playerAccountController->getUserNextGame($idteams);


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../CSS/styles/globalStyles.css">
    <link rel="stylesheet" href="../CSS/styles/subpage_central.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <title>Centrala</title>
</head>
<body>
    <div class="gray-room-bg central">
        <div class="user-info-wrapper">
            <div class="user-info">
                <div class="user-info__logo">
                    <?php echo '<img src="../CSS/pictures/shields/'.$idteams.'.png" alt="herb">'; ?>
                </div>
                <div class="user-info__team-and-name">
                    <span class="user-name">
                     <?php echo $_SESSION['gamertag']; ?>
                    </span>
                    <span class="team-name">
                        <?php echo $_SESSION['teamname']; ?>
                    </span>
                </div>
            </div>
            <div class="user-morale" title="ogólno rozumiany poziom zadowolenia panujący w klubie">
                <?php echo '100'; //$satisfaction ?>
            </div>
        </div>

        <div class="nav-and-content-wrapper">
            <nav class="main-nav">
                <a class="main-nav__item active" href="#">
                   <span>Centrala</span>
                </a>
                <a class="main-nav__item" href="../myteam/myTeamView">
                    <span>Skład</span>
                </a>
                <a class="main-nav__item" href="../transfery">
                    <span>Transfery</span>
                </a>
                <a class="main-nav__item" href="http://menagoleague.pl/mail/MessagesView?recived=on">
                    <span>Biuro</span>
                </a>
                <a class="main-nav__item" href="../tabela/tit2">
                    <span>Sezon</span>
                </a>
            </nav>

            <main class="content-block central">
                <section class="content-block__first">
                    <div class="content-block__first-titles">
                        <h2>NADCHODZĄCE MECZE</h2>
                        <h3>Luty 2020</h3>
                    </div>

                    <div class="days-wrapper">
                        <div class="day">
                            <span>
                                Mon
                            </span>
                            <div class="line"></div>
                            <span>
                                15
                            </span>
                        </div>
                        <div class="day">
                            <span>
                                Mon
                            </span>
                            <div class="line"></div>
                            <span>
                                15
                            </span>
                        </div>
                        <div class="day">
                            <span>
                                Mon
                            </span>
                            <div class="line"></div>
                            <span>
                                15
                            </span>
                        </div>
                        <div class="day">
                            <span>
                                Mon
                            </span>
                            <div class="line"></div>
                            <span>
                                15
                            </span>
                        </div>
                        <div class="day">
                            <span>
                                Mon
                            </span>
                            <div class="line"></div>
                            <span>
                                15
                            </span>
                        </div>
                    </div>
                </section>

                <section class="content-block__second">

                  <!-- FLYING MININAV -->
                  <nav class="content-block__nav second">
                    <div id="first" class="flying-nav-central second-section active"></div>
                    <div id="second" class="flying-nav-central second-section"></div>
                </nav>
                <!-------------------->

                <div class="content-block__second-wrapper">

                <div class="content-block__second-first-child">
                    <?php 
                    if(empty($getUserNextGame))
                    {
                        echo  '<div class="notification-wrapper">
                        <div class="notification-wrapper__person">
                            <img src="../CSS/pictures/seller.png" alt="">
                            <span class="name">
                                Stefan Drążyskała
                            </span>
                            <span class="proffesion">
                                Asystent Trenera
                            </span>
                        </div>
                        <div class="notification-wrapper__message-wrapper">
                            <span class="notification-wrapper__date">
                                02.02.2020 10:40
                            </span>
                            <div class="notification-wrapper__message">
                                <img src="../CSS/pictures/real-triangle (1).svg" alt="" class="triangle">
                                - Dzień Dobry, szefie. Obecnie nie mamy nadchodzących spotkań.
                            </div>
                            <div class="notification-wrapper__message">
                                <img src="./images/real-triangle (1).svg" alt="" class="triangle">
                                - Żaden nasz piłkarz nie jest obecnie zawieszony lub kontuzjowany.
                            </div>
                            ';
                    } else {
                            foreach($getUserNextGame as $game)
                            {
                                $date = $game['data'];

                                if($game['idteam1'] == $idteams)
                                {
                                    $opponentID = $game['idteam2'];
                                } else
                                {
                                    $opponentID = $game['idteam1'];
                                }
                                
                                
                                
                            
                                echo '  <div class="notification-wrapper">
                                <div class="notification-wrapper__person">
                                <img src="../CSS/pictures/seller.png" alt="">
                                <span class="name">
                                Stefan Drążyskała
                                </span>
                                <span class="proffesion">
                                Asystent Trenera
                                </span>
                                </div>
                                <div class="notification-wrapper__message-wrapper">
                                 <span class="notification-wrapper__date">
                                02.02.2020 10:40
                                </span>
                                <div class="notification-wrapper__message">
                                <img src="./images/real-triangle (1).svg" alt="" class="triangle">
                                Dzień Dobry, Szefie! Miło Cię znów widzieć! Co to ja miałem... a, już wiem!
                                Już niedługo, bo <b>'.$date.'</b> czeka nas ważny mecz przeciwko
                                <img src="../CSS/pictures/shields/'.$opponentID.'.png" alt="herb" width="30px" height="30px">
                                 <p>-Jeśli istnieje taka potrzeba, mogę spróbować  <form method="GET" action="../fixtures/fixturesView">
                                <input type="submit" value="Przełożyć Mecz" name="reschedule"></form> 
                                Pamiętaj również, że musimy
                                 <form method="GET" action="../fixtures/fixturesView">
                                 <input type="submit" value="Zgłosić Wynik" name="set_score" class="central_button">
                                </form> do federacji  Menago League przed upływem terminu spotkania! </p>
                                <a href="https://gamerdvr.com/gamer/'.$gamertag.'/videos" target="_blank">Dostęp do raportów</a>
                                </div>

                             <div class="notification-wrapper__message">
                                <img src="./images/real-triangle (1).svg" alt="" class="triangle">
                               
                                 Nasi analitycy taktyczni przygotowali obszerny raport na temat naszego przeciwnika. Pozwól, że Ci go streszczę.
                                 - Malen to najsilniejsze ogniwo naszych rywali. Zdobył w tym sezonie 6 bramek i 4 asyty, notująć średnią ocenę meczową 9,663
                                 - Coutinho to najlepszy asystent ligi. prowadzi w klasyfikacji, mając na koncie 8 asyst.
                                 - Chelsea jest niepokonana od 4 kolejek, zdobywając 15 goli i tracąc przy tym 0 bramek.
                                 - Jarosław Kaczyński musi zająć się chorym kotem i prawdopodobnie dostanie wolne na mecz przeciwko nam.
                                 - Sławomir nabawił się kontuzji czoła. Uraz będzie leczył w Zakopanem, oblewając się szampanem. <br>

                                 - Przewidywany skład rywali: Malen, Coutinho, Diego Costa, Grzegorz Rasiak, Artur Boruc, Tomasz Tomaszewski, Adamiak Adam, Leo Messi, Ramos, Andrzej Duda

                                
                            </div>
                        </div>
                    </div>';
                        }
                    }
                ?>
                  

                    </div>
                        <div class="content-block__second-second-child">
                        <h1>ELEMENT W BUDOWIE</h1>
                        </div>
                    </div>
                </section>

                <section class="content-block__third">
                    <i><h2>OSTATNIE TRANASFERY</h2></i>

                    <div class="last-transfers-wrapper">
                   
                        <?php 
                            if(empty($getLastTransfers))
                            {
                                echo 'W obecnym oknie transferowym nie przeprowadzono zadnego transferu';   
                            }   else {
                                    foreach($getLastTransfers as $transfer)
                                { 
                                    $price = $transfer['kwota']; 
                                    $playername = $transfer['playername'];
                                    $sellerID = $transfer['id_s'];
                                    $buyerID = $transfer['id_k'];

                                    echo '    <div class="last-transfer">
                                    <div class="last-transfer__footballer">
                                        <img src="../CSS/pictures/messi.png" alt="">
                                    </div>
                                    
                                    <div class="last-transfer__logo">
                                      <img src="../CSS/pictures/shields/'.$sellerID.'.png" alt="Sprzedający">
                                    </div>
                                    
                                    <div class="last-transfer__price-and-surname">
                                        <span>'.$price.' <i>M$</i></span>
                                        <img src="../CSS/pictures/arrow.svg" alt="">
                                        <span>'.$playername.'</span>
                                    </div>

                                    <div class="last-transfer__logo">
                                    <img src="../CSS/pictures/shields/'.$buyerID.'.png" alt="Kupujący"> 
                                        </div>
                                </div>';
    
                                }
                            } 
                        ?>
                </section>

                <section class="content-block__fourth">

                    <!-- FLYING MININAV -->
                    <nav class="content-block__nav fourth">
                        <div id="first" class="flying-nav-central fourth-section active"></div>
                        <div id="second" class="flying-nav-central fourth-section"></div>
                        <div id="third" class="flying-nav-central fourth-section"></div>
                    </nav>
                    <!-------------------->

                    <div class="content-block__fourth-wrapper">

                        <div class="content-block__fourth-first-child">

                            <div class="content-block__fourth-title-and-logo">

                                <i><h2>TABELA</h2></i>
                                <?php echo ' <img src="../CSS/pictures/shields/'.$idteams.'.png" alt="Tarcza klubu">'; ?>
                            </div>
                            <div class="content-block__fourth-pld-pts">
                                <span>GP</span>
                                <span>PKT</span>
                            </div>
                            <div class="table teams">
                                <?php 
                                if(empty($getUserLeagueTable))
                                {
                                echo 'Pusto';   

                                for ($x = 1; $x <= 10; $x++) {
                              echo $x;
                                    }
    
                                 }   else {
                                        $x=1;
                                    foreach($getUserLeagueTable as $table)
                                    {
                                    

                                    
                                       $pkt = $table['pkt'];
                                        $GP = $table['GP'];
                                        $tableTeamID = $table['idteams'];
                                        $tableTeamname = $table['teamname'];
                                        echo '   <div class="table__element teams">
                                        <span class="table__element-numeration">'.$x++.'
                                    
                                        </span>
                                        
                                        <div class="table__element-team">
                                            <img src="../CSS/pictures/shields/'.$tableTeamID.'.png" alt="Tarcza klubu">
                                            <span>'.$tableTeamname.'</span>
                                        </div>
                                        <span class="table__element-pld">
                                        '.$GP.'
                                        </span>
                                        <span class="table__element-pts">
                                        '.$pkt.'
                                        </span>
                                        </div>';
        
                                    }
                                }

                        ?>
                              
                            </div>
                        </div>

                        <div class="content-block__fourth-second-child ">
                            <i><h2>Król Strzelców</h2></i>

                            <div class="table goals">
                           

                            <?php
                                if(empty($getUserLeagueTopScorer))
                                {
                                    echo 'Opcja chwilowo niedostępna';
                                } else

                                {       $x =1;
                                       foreach($getUserLeagueTopScorer as $scorer) 
                                    
                                    {   
                                       
                                        $scorerTeamID = $scorer['idteams'];
                                        $scorername = $scorer['playername'];
                                        $goals = $scorer['gole'];
                                        echo '<div class="table__element goals">
                                        <span class="table__element-numeration">'.$x++.'
                                            
                                        </span>

                                        <div class="table__element-team">
                                            <img src="../CSS/pictures/shields/'.$scorerTeamID.'.png" alt="Tarcza klubu">
                                        </div>
    
                                            <span>'.$scorername.'</span>
    
                                        <span class="table__element-pld goals">
                                            '.$goals.'
                                        </span>
                                        </div>';
                                        
                                    }
                                }
                            ?>

                                

                            </div>
                        </div>

                          

                        <div class="content-block__fourth-third-child ">
                            <i><h2>NAJWIĘCEJ ASYST</h2></i>
                            <?php
                                if(empty($getUserLeagueTopAsistants))
                                {
                                    echo 'Ta opcja jest chwilowo niedostępna';
                                } else
                                {   $x=1;
                                    foreach($getUserLeagueTopAsistants as $asistant) 
                                    
                                    {   
                                       
                                        
                                        $asistantname = $asistant['playername'];
                                        $asists = $asistant['SUM(asysty)'];
                                        echo '<div class="table__element goals">


                                <span class="table__element-numeration">
                                    '.$x++.'
                                </span>

                                    <span>'.$asistantname.'</span>

                                <span class="table__element-pld goals">
                                    '.$asists.'
                                </span>
                            </div>';
                                        
                                    }
                                }
                            ?> 
                           

                           
                        </div>
                    </div>

                    </div>
                    </section>
                </section>
            </main>
        </div>

    </div>

    <script src="../scripts/subpage_central.js"></script>
    
    <p>Icons made by <a href="https://www.flaticon.com/authors/eucalyp" title="Eucalyp">Eucalyp</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></p>
    <div>Icons made by <a href="https://www.flaticon.com/authors/vectors-market" title="Vectors Market">Vectors Market</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>

    
</body>
</html>
