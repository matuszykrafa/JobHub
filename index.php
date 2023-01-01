<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], "/");
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::get('offer', 'OfferController');
Routing::get('getOffersWithTags', 'OfferController');
Routing::post('add-offer', 'OfferController');
Routing::post('delete-offer', 'OfferController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('logout', 'SecurityController');
Routing::run($path);