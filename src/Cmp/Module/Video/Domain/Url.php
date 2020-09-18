<?php


namespace Cmp\Module\Video\Domain;


class Url
{
    private $value;

    public function __construct(String $value)
    {
        $this->value = $value;
    }

    public function value(): String
    {
        return $this->value;
    }
}