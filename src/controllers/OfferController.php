<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/TagRepository.php';
require_once __DIR__.'/../repository/OfferRepository.php';
class OfferController extends AppController
{
    private OfferRepository $offerRepository;
    public function __construct()
    {
        parent::__construct();
        $this->offerRepository = new OfferRepository();
    }
    public function offer() {

        if (!isset($_GET['offerId'])) {
            $this->moveToLocation("home");
            return;
        }

        $offer = $this->offerRepository->getOffer($_GET['offerId']);
        if (!$offer) {
            $this->moveToLocation("home");
            return;
        }

        $this->render('offer', ['offer' => $offer]);
    }
    public function addoffer() {
        if (!$this->isAuthenticated()) {
            $this->moveToLocation("home");
            return;
        }

        if (!$this->isPost()) {
            $tagRepository = new TagRepository();
            $tags = $tagRepository->getTags();
            $this->render('add-offer', ['tags' => $tags]);
            return;
        }

        $title = $_POST['title'];
        $company = $_POST['company'];
        $localization = $_POST['localization'];
        $salary = $_POST['salary'];
        $requirements = $_POST['requirements'];
        $details = $_POST['details'];
        $contact = $_POST['contact'];

        $offer = new Offer($title, $company, $localization, $salary, $requirements, $details, $contact);

        $id = $this->offerRepository->addOffer($offer);
//        foreach ($_POST['tags'] as $tag)
//            echo " ".$tag." ";

        if (!$id) {
            $this->moveToLocation("home");
            return;
        }
        $this->moveToLocation("offer?offerId=".$id);
    }
}