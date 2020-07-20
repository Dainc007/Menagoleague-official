<!DOCTYPE html>
<html lang="pl-PL">

<head>
    
    <title> Menago League </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="description" content="blablabla" />
    <meta name="keywords" content="blablabla" />

    <!-- Normalize file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" 
    integrity="sha256-l85OmPOjvil/SOvVt3HnSSjzF1TUMyT9eV0c2BzEGzU=" crossorigin="anonymous">
    
    <!-- Login and password css file -->
    <link rel="stylesheet" href="/CSS/login.css">
    <!-- Register html file -->
    <link rel="stylesheet" href="register.php">

</head>
<body>

    <section class="container">
        <a href="index.php" class="login__logo-link"> 
            <img src="CSS/pictures/logo.png" alt="Logo strony" class="login__logo-image">
        </a>
        <div class="login-container">
            <h3 class="login-container__header">
                Zaloguj się
            </h3>
            <form action="zaloguj.php" method="post">
                <div class="input-container input-effect-container">
                    <input class="input-effect-style" type="text" name="login" placeholder="Nazwa użytkownika" required>
                </div>
                <div class="input-container input-effect-container">
                    <input class="input-effect-style" type="password" placeholder="Hasło" name="haslo" required>
                </div>
                <div class="input-container">
                    <input type="checkbox" class="checkbox-style">
                    Nie wylogowuj mnie
                </div>
                <div class="input-container__button">
                    <input type="image" name="submit" src="pictures/login.png" alt="Submit" class="input-container__button-image" />
                </div>
            </form>
            <div class="login-container__problems">
                <a href="loginproblems.html" class="login-other-link">
                    Nie możesz się zalogować?
                </a>
            </div>
            <div class="login-container__newaccount">
                <a href="rejestracja.php" class="login-other-link">
                    Stwórz konto!
                </a> 
            </div>
            <div class="login__last-sentence">
                <a href="index.php" class="login__last-sentence-link">
                <img src="CSS/pictures/outdoor.png" class="login__last-sentence-image" alt="Drzwi" />
                </a>
            </div>
        </div>
    </section>

</body>
</html>