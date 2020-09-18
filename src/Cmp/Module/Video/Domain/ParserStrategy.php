<?php


namespace Cmp\Module\Video\Domain;


interface ParserStrategy
{
    public function isApplicable(Provider $provider): bool;

    public function parse(String $filename): Videos;
}