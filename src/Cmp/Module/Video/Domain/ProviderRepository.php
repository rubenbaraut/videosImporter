<?php


namespace Cmp\Module\Video\Domain;


interface ProviderRepository
{
    public function findByName(String $name): ?Provider;
}