<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <title>JobHub - login</title>
</head>

<body>
<?php include('header.php')?>
<div class="container">
    <div class="content-container login-container">
        <div class="heading-container">
            <div class="heading-content">
                <img alt="login icon"  class="icon" src="public/img/login-icon.svg">
                <span>Zaloguj</span>
            </div>
            <hr class="heading-line"/>
        </div>
        <form class="form" action="login" method="POST">
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
            <input required class="input" name="password" type="password" placeholder="hasło">
            <button class="button" type="submit">Login</button>
        </form>
    </div>
</div>
</body>