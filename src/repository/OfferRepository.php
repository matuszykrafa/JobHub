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
        );
    }

    public function addOffer(Offer $offer): int {
        $conn = $this->database->connect();
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
        return  $conn->lastInsertId();
    }
}