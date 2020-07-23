<?php
include"../functions.php";
include"MessagesController.php";
echo '<a href="kontogracza.php">POWRÓT</a>';
if (empty($receivedMessages))
{
    echo "<br>Nie masz nowych wiadomości";
} else { echo '<h5> Otrzymane wiadomości</h5>';
        foreach ($receivedMessages as $message)
        {
        echo 'Klub '.$message['teamname'].' przesłał nam wiadomość dnia '.$message['data'].' <br>Temat:'.$message['topic'].' <br> '.$message['message'].'<br><br>';
        } echo '<form method="POST" action="MessagesController.php"><input type="submit" name="markAsRead" value="Przenieś stare wiadomości do przeczytanych"></form>';
    }

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
