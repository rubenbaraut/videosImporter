<?php


namespace Cmp\Module\Video\Domain;


class Tag
{
    private $name;

    public function __construct(String $name)
    {
        $this->name = $name;
    }

    public function name(): String
    {
        return $this->name;
    }

    public function __toString(): String
    {
        return $this->name;
    }
}