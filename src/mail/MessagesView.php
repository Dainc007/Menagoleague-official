<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../CSS/messagesView.css" type="text/css">
  </head>
  <body>
  
<?php
include"../functions.php";
include"MessagesController.php";
echo '<div><a href="../kontogracza">POWRÓT</a></div>';

echo '<div><button><a href="http://menagoleague.pl/mail/MessagesView?recived=on">Otrzymane</a></button> 
        <button><a href="http://menagoleague.pl/mail/MessagesView?send=on">Wysłane</a></button></div>';

if(isset($_GET['recived']))
{

if (empty($receivedMessages))
{
    echo "<br>Nie masz nowych wiadomości";
} else { echo '<div class="messages">
        <table class="recived"> <tr><th>Temat</th><th>Wiadomość od Klubu</th><th>Zawartość</th><th>Data</th><th>Treść Wiadomości</th></tr>';
        
        foreach ($receivedMessages as $message)
        {
        echo '<tr><td>'.$message['topic'].'</td>  <td> '.$message['teamname'].'<td>'.$message['message'].'</td> <td>'.$message['data'].'</td> <td>'.$message['message'].'</td>  </tr>';
        
        } echo '</table></div>';
    }

}

if(isset($_GET['send']))
{
    if (empty($sentMessages)){
        echo 'Nie wysłałeś jeszcze żadnej wiadmości';
     }    else { echo '<div class="messages">
        <table class="recived"> <tr><th>Temat</th>              <th> </th><th>Data</th><th>Treść Wiadomości</th></tr>';
        foreach ($sentMessages as $message)
        {
        echo '<tr> <td>'.$message['topic'].'</td>  <td> '.$message['teamname'].' </td>  <td>'.$message['data'].'</td><td>'.$message['message'].'</td>  </tr>';
        } echo '</table></div>';
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
</form>
</body>
</html>