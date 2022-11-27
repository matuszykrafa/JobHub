<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>JobHub - login</title>
</head>

<body>
<header>
    <div class="header-buttons"></div>
    <div class="header-title">
        <a href="home">JobHub</a>
    </div>
    <div class="header-buttons">>
        <a href="register">Rejestracja</a>
    </div>
</header>
<div class="container">
    <div class="login-container">
        <div class="heading-container">
            <div class="heading-content">
                <img class="icon" src="public/img/login-icon.svg">
                <span>Zaloguj</span>
            </div>
            <hr class="heading-line"/>
        </div>
        <form class="login" action="login" method="POST">
            <div class="messages">
            </div>
            <input class="input" name="email" type="text" placeholder="login">
            <input class="input" name="password" type="password" placeholder="hasło">
            <button class="button" type="submit">Login</button>
        </form>
    </div>
</div>
</body>