<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <title>JobHub - rejestracja</title>
</head>

<body>
<?php include('header.php')?>
<div class="container">
    <div class="content-container login-container">
        <div class="heading-container">
            <div class="heading-content">
                <img alt="register icon" class="icon" src="public/img/register-icon.svg">
                <span>Zarejestruj</span>
            </div>
            <hr class="heading-line"/>
        </div>
        <form class="form" action="register" method="POST">
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input class="input" name="login" type="text" placeholder="login">
            <input class="input" name="email" type="text" placeholder="email">
            <input class="input" name="password" type="password" placeholder="hasło">
            <input class="input" name="repeat_password" type="password" placeholder="powtórz hasło">
            <input class="input" name="company" type="text" placeholder="nazwa firmy (opcjonalnie)">
            <button class="button" type="submit">Rejestracja</button>
        </form>
    </div>
</div>
</body>