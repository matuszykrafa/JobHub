<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <script type="text/javascript" src="./public/js/register.js" defer></script>
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
            <input required class="input" name="email" type="email" placeholder="email">
            <input minlength="5" required class="input" name="password" type="password" placeholder="hasło">
            <input minlength="5" required class="input" name="repeat_password" type="password" placeholder="powtórz hasło">
            <input minlength="5" required class="input" name="login" type="text" placeholder="login">
            <button class="button" type="submit">Rejestracja</button>
        </form>
    </div>
</div>
</body>