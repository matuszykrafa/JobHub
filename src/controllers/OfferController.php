<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/TagRepository.php';
require_once __DIR__.'/../repository/OfferRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';
class OfferController extends AppController
{
    private OfferRepository $offerRepository;
    private UserRepository $userRepository;
    private TagRepository $tagRepository;
    public function __construct()
    {
        parent::__construct();
        $this->offerRepository = new OfferRepository();
        $this->userRepository = new UserRepository();
        $this->tagRepository = new TagRepository();
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
        $this->render('offer', ['offer' => $offer, 'canBeManaged' => $this->canBeManaged($offer)]);
    }
    public function addoffer() {
        if (!$this->isAuthenticated()) {
            $this->moveToLocation("home");
            return;
        }

        if (!$this->isPost()) {
            $tags = $this->tagRepository->getTags();
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
        $userId = $this->userRepository->getUserIdBySessionGuid();
        $tags = $_POST['tags'];

        $offer = new Offer($title, $company, $localization, $salary, $requirements, $details, $contact, $userId);

        $id = $this->offerRepository->addOffer($offer);
        //$this->tagRepository->addTags($tags);
//        foreach ($_POST['tags'] as $tag)
//            echo " ".$tag." ";

        if (!$id) {
            $this->moveToLocation("home");
            return;
        }
        $this->moveToLocation("offer?offerId=".$id);
    }

    public function deleteoffer() {
        if (!$this->isAuthenticated() || !$this->isPost()) {
            $this->moveToLocation("home");
            return;
        }

        $userId = $this->userRepository->getUserIdBySessionGuid();
        $offerId = $_POST['offerId'];
        $offer = $this->offerRepository->getOffer($offerId);

        if ($userId != $offer->getUserId()) {
            echo "Unauthorized";
            return;
        }

        $this->offerRepository->deleteOffer($offerId);
        $this->moveToLocation("home");
    }

    private function canBeManaged(Offer $offer): bool {
        $user = $this->userRepository->getUserBySessionGuid();
        if (!$user) return false;

        $offerIsCreatedByUser = $user->getId() === $offer->getUserId();
        $userIsAdmin = $user->getRole() === RoleEnum::Admin;
        return $offerIsCreatedByUser || $userIsAdmin;
    }
}