<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
class SessionRepository extends Repository
{

    public function createSession(int $userId): string
    {
        $stmt = $this->database->connect()->prepare('INSERT INTO sessions ("userId", "sessionGuid") VALUES (?, ?)'
        );
        $guid = $this->createGUID();
        $stmt->execute([
            $userId,
            $guid
        ]);
        return $guid;
    }

    public function sessionExists(string $sessionGuid): bool {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.sessions WHERE "sessionGuid" = :guid
        ');
        $stmt->bindParam(':guid', $sessionGuid, PDO::PARAM_STR);
        $stmt->execute();

        $session = $stmt->fetch(PDO::FETCH_ASSOC);

        return $session != false;
    }

    private function createGUID()
    {
        mt_srand((double)microtime()*10000);
        $set_charid = strtoupper(md5(uniqid(rand(), true)));
        $set_hyphen = chr(45);
        $set_uuid =
            substr($set_charid, 0, 8).$set_hyphen
            .substr($set_charid, 8, 4).$set_hyphen
            .substr($set_charid,12, 4).$set_hyphen
            .substr($set_charid,16, 4).$set_hyphen
            .substr($set_charid,20,12);
        return $set_uuid;
    }
}