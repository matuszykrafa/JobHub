<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <link rel="stylesheet" type="text/css" href="public/css/home.css">
    <title>JobHub</title>
</head>

<body>
<?php include('header.php')?>
<div class="container jc-start">
    <div class="search-container">
        <div class="search-wrapper">
            <img alt="search icon" class="search-icon icon" src="public/img/search-icon.svg">
            <input class="search-input" type="text" placeholder="Wyszukaj ofertę..."/>
        </div>
    </div>
    <div class="content-container">
        <div class="heading-container">
            <div class="heading-content">
                <img alt="jobs icon" class="icon" src="public/img/favourite-icon.svg">
                <span>Oferty pracy</span>
            </div>
            <hr class="heading-line"/>
        </div>
        <div class="offers-container">
            <div class="offer-list-item">
                <div class="offer-short-desc">
                    <span>Frontend developer (React)</span>
                    <span class="smaller-text">NewSpace</span>
                </div>
                <div class="tags-home-container tags-content">
                    <div class="tag">Mid</div>
                    <div class="tag">React</div>
                    <div class="tag">Zdalnie</div>
                    <div class="tag">15 000 PLN</div>
                </div>
            </div>

        </div>
        <div class="offers-container">
            <div class="offer-list-item">
                <div class="offer-short-desc">
                    <span>Frontend developer (React)</span>
                    <span class="smaller-text">NewSpace</span>
                </div>
                <div class="tags-home-container tags-content">
                    <div class="tag">Mid</div>
                    <div class="tag">React</div>
                    <div class="tag">Zdalnie</div>
                    <div class="tag">15 000 PLN</div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>