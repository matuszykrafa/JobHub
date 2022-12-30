<?php

class Session
{
    private $id;
    private $userId;
    private $sessionGuid;

    public function __construct(
        $id,
        $userId,
        $sessionGuid
    )
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->sessionGuid = $sessionGuid;
    }
}