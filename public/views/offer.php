<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <link rel="stylesheet" type="text/css" href="public/css/offer.css">
    <title>JobHub</title>
</head>

<body>
<?php include('header.php')?>
<div class="container">
    <?php if(isset($offer)) { ?>
        <div class="content-container offer-container">
            <div class="heading-container">
                <div class="heading-content">
                    <img alt="job icon" class="offer-icon icon" src="public/img/job-icon.svg">
                    <div class="offer-heading-text-container">
                        <span class="job-title"><?= $offer->getTitle();?></span>
                        <span class="company-name smaller-text"><?= $offer->getCompany();?></span>
                    </div>
                    <?php if(isset($canBeManaged) && $canBeManaged === true) { ?>
                    <form action="delete-offer" method="post">
                        <input name="offerId" value="<?= $offer->getId();?>" hidden="hidden"/>
                        <button type="submit" class="tag red-tag button-tag">Usuń</button>
                    </form>
                    <?php } ?>
                </div>
                <hr class="heading-line"/>
            </div>
            <div class="offer-content-container">
                <div class="offer-desc-container">
                    <div class="offer-requirements content-background">
                        <div class="offer-content-heading">
                            <span>Opis wymagań</span>
                            <hr class="heading-line offer-line"/>
                        </div>
                        <div class="offer-text-content"><?= $offer->getRequirements();?></div>
                    </div>
                    <div class="offer-desc content-background">
                        <div class="offer-content-heading">
                            <span>Szczegóły</span>
                            <hr class="heading-line offer-line"/>
                        </div>
                        <div class="offer-text-content"><?= $offer->getDetails();?></div>
                    </div>
                </div>
                <div class="offer-crucial-info content-background">
                    <div class="salary-localization-wrapper">
                        <div class="padding-0 offer-content-heading crucial-info-heading">
                            <div class="crucial-content-container">
                                <span class="salary-text"><?= $offer->getSalary();?> PLN</span>
                                <span class="smaller-text">Brutto miesięcznie</span>
                            </div>
                            <hr class="heading-line offer-line"/>
                        </div>

                        <div class="padding-0 offer-content-heading crucial-info-heading">
                            <div class="crucial-content-container">
                                <span><?= $offer->getLocalization();?></span>
                                <span class="smaller-text">Lokalizacja</span>
                            </div>
                            <div class="crucial-content-container">
                                <span><?= $offer->getContact();?></span>
                                <span class="smaller-text">Kontakt</span>
                            </div>
                            <hr class="heading-line offer-line"/>
                        </div>
                    </div>
                    <div class="padding-0 offer-content-heading tags-wrapper">
                        <div class="tags-title">
                            <span class="smaller-text">Tagi</span>
                        </div>
                        <div class="tags-content">
                            <div class="tag">Junior</div>
                            <div class="tag">C#</div>
                            <div class="tag">Zdalnie</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>

</div>
</body>