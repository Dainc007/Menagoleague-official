<?php
include"pdo.php";

foreach ($users as $user)
{
    echo $user['teamname'].' - '.$user['idteams'].' - '.$user['money'].' - '.$user['pensjazespolu'].'<br>';
}
