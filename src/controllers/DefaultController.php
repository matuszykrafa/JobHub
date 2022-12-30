<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    private OfferRepository $offerRepository;
    public function __construct()
    {
        parent::__construct();
        $this->offerRepository = new OfferRepository();
    }
    public function home() {
        $offers = $this->offerRepository->getOffers();
        $this->render('home', ['offers' => $offers]);
    }
}