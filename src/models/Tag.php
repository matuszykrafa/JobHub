<?php

class Tag
{
    private $id;
    private $tagName;

    public function __construct(
        string $tagName,
        int $id = 0
    ) {
        $this->id = $id;
        $this->tagName = $tagName;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTagName()
    {
        return $this->tagName;
    }
}