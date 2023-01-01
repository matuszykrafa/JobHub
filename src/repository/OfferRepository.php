<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Offer.php';
class OfferRepository extends Repository
{

    public function getOffers() {
        $result = [];

        $stmt = $this->database->connect()->prepare('SELECT * FROM offers;');
        $stmt->execute();
        $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($offers as $offer) {
            $result[] = new Offer(
                $offer['title'],
                $offer['company'],
                $offer['localization'],
                $offer['salary'],
                $offer['requirements'],
                $offer['details'],
                $offer['contact'],
                $offer['userId'],
                $offer['id'],
            );
        }
        return $result;
    }

    public function getOffersWithTags() {

        $stmt = $this->database->connect()->prepare('
            SELECT offers.*, array_to_json(string_to_array(string_agg(tags."tagName", \';\'),\';\')) as tags FROM offers 
            INNER JOIN offers_tags ON offers."id" = offers_tags."offerId" 
            INNER JOIN tags ON offers_tags."tagId" = tags."id" 
            GROUP BY offers.id, offers.title, offers.company, offers.localization, offers.salary, offers.requirements, 
                     offers.details, offers.contact, offers."userId";
        ');
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOffer(int $id): ?Offer {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.offers WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $offer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($offer == false) {
            return null;
        }

        return new Offer(
            $offer['title'],
            $offer['company'],
            $offer['localization'],
            $offer['salary'],
            $offer['requirements'],
            $offer['details'],
            $offer['contact'],
            $offer['userId'],
            $offer['id']
        );
    }

    public function addOffer(Offer $offer, $tags): int {
        $conn = $this->database->connect();
        $conn->beginTransaction();
        $stmt = $conn->prepare('
            INSERT INTO offers (title, company, localization, salary, requirements, details, contact, "userId")
VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $offer->getTitle(),
            $offer->getCompany(),
            $offer->getLocalization(),
            $offer->getSalary(),
            $offer->getRequirements(),
            $offer->getDetails(),
            $offer->getContact(),
            $offer->getUserId()
        ]);
        $offerId = $conn->lastInsertId();

        foreach ($_POST['tags'] as $tagId) {
            $stmt = $conn->prepare('INSERT INTO offers_tags ("tagId", "offerId") VALUES (?, ?)');
            $stmt->execute([$tagId, $offerId]);
        }
        $conn->commit();
        return  $offerId;
    }

    public function deleteOffer(int $offerId) {
        $conn = $this->database->connect();
        $stmt = $conn->prepare('
            DELETE FROM offers where offers.id = :offerId'
        );
        $stmt->bindParam(':offerId', $offerId, PDO::PARAM_INT);
        $stmt->execute();
    }
}