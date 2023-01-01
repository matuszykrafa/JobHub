<?php
require_once 'Repository.php';
require_once __DIR__.'/../models/Tag.php';
class TagRepository extends Repository
{
    public function getTags() {
        $result = [];

        $stmt = $this->database->connect()->prepare('SELECT * FROM tags;');
        $stmt->execute();
        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tags as $tag) {
            $result[] = new Tag(
                $tag['tagName'],
                $tag['id']
            );
        }
        return $result;
    }

    public function getTagsForOffer(int $offerId) {
        $result = [];

        $stmt = $this->database->connect()->prepare(
            'SELECT tags.* FROM tags JOIN offers_tags ON tags."id" = offers_tags."tagId" 
                    WHERE offers_tags."offerId" = :offerId');
        $stmt->bindParam(':offerId', $offerId, PDO::PARAM_INT);
        $stmt->execute();
        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($tags as $tag) {
            $result[] = new Tag(
                $tag['tagName'],
                $tag['id']
            );
        }
        return $result;
    }
}