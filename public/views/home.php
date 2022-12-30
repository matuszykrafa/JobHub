<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <link rel="stylesheet" type="text/css" href="public/css/home.css">
    <script type="text/javascript" src="./public/js/home.js" defer></script>
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
        <?php if(isset($offers)) foreach ($offers as $offer): ?>
            <div class="offers-container">
                <div id="<?= $offer->getId(); ?>" class="offer-list-item">
                    <div class="offer-short-desc">
                        <span><?= $offer->getTitle();?></span>
                        <span class="smaller-text"><?= $offer->getCompany();?></span>
                    </div>
                    <div class="tags-home-container tags-content">
                        <div class="tag">Mid</div>
                        <div class="tag">React</div>
                        <div class="tag"><?= $offer->getLocalization();?></div>
                        <div class="tag"><?= $offer->getSalary();?> PLN</div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>