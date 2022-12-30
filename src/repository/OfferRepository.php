<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Offer.php';
class OfferRepository extends Repository
{

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
        );
    }

    public function addOffer(Offer $offer): int {
        $conn = $this->database->connect();
        $stmt = $conn->prepare('
            INSERT INTO offers (title, company, localization, salary, requirements, details, contact)
VALUES (?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $offer->getTitle(),
            $offer->getCompany(),
            $offer->getLocalization(),
            $offer->getSalary(),
            $offer->getRequirements(),
            $offer->getDetails(),
            $offer->getContact()
        ]);
        return  $conn->lastInsertId();
    }
}