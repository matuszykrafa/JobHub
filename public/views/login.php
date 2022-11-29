<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>JobHub - login</title>
</head>

<body>
<header>
    <div class="menu-left"></div>
    <label class='menu-button-container' for="menu-toggle"></label>
    <div class="header-title">
        <a href="home">JobHub</a>
    </div>
    <input id="menu-toggle" type="checkbox" />
    <label class='menu-button-container' for="menu-toggle">
        <div class='menu-button'></div>
    </label>
    <div class="menu">
        <a href="register">Rejestracja</a>
    </div>
</header>
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
            </div>
            <input class="input" name="email" type="text" placeholder="login">
            <input class="input" name="password" type="password" placeholder="hasło">
            <button class="button" type="submit">Login</button>
        </form>
    </div>
</div>
</body>