<html>
<head>
<link rel="stylesheet" href="/CSS/messagesView.css" type="text/css">
</head>
<body>
<?php
include"../functions.php";
include"MessagesController.php";
echo '<div class="exit"><a href="kontogracza.php">POWRÓT</a></div>';
if (empty($receivedMessages))
{
    echo "Nie masz nowych wiadomości";
} else { echo '<div class="messages"><nav>
        <a href="">Otrzymane</a> |
        <a href="">Wysłane</a></nav>
        <table class="recived"> <tr><th>Temat</th><th>Wiadomość od Klubu</th><th>Data</th></tr>';
        
        foreach ($receivedMessages as $message)
        {
        echo '<tr> <td>'.$message['topic'].'</td>  <td> '.$message['teamname'].' </td>  <td>'.$message['data'].'</td>  </tr>';
        } echo '</table></div>';
    } //Ten formularz spróbujemy zastąpić innym rozwiązaniem.
    //Niech kada wiadomość zostanie oznaczona jako przeczytana po kliknięciu<form method="POST" action="MessagesController.php">
    //<input type="submit" name="markAsRead" value="Przenieś stare wiadomości do przeczytanych"></form>

if (empty($sentMessages)){
    echo 'Nie wysłałeś jeszcze żadnej wiadmości';
} else { echo '<h5> Wysłane wiadomości</h5>';
        foreach ($sentMessages as $message)
        {
        echo $message['id'].' - '.$message['topic'].' - '.$message['message'].' - '.$message['data'].'<br>';
        }
    }

if(empty($getRecipients)) {
    echo 'Skrzynka nadawcza napotkała problem';
    } else { echo'<form method="POST" action="createMessage.php">
            <input type="text" min="2" max="50" name="topic" required>Temat<br>
            <input type="text" min="2" max="300" name="message" required>Treść wiadomości<br>
            <select name="recipient" >';
            for($i=1; $i<40; $i++){
            foreach ($getRecipients as $recipient)
            {
            echo '<option value="'.$i++.'">'.$recipient['teamname'].' (id'.$recipient['idteams'].')</option>';
            
            
            }
        } echo '</select>Odbiorca<br><input type="submit" name="createMessage" value="Wyślij"></form>';

    }


?>
</body>
</html>
