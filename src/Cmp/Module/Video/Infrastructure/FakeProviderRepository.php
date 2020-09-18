<?php


namespace Cmp\Module\Video\Infrastructure;


use Cmp\Module\Video\Domain\Provider;
use Cmp\Module\Video\Domain\ProviderRepository;

class FakeProviderRepository implements ProviderRepository
{

    public function findByName(String $name): ?Provider
    {
        if ($name === "flub") {
            return new Provider("flub", 'yml', "flub.yaml");
        }

        if ($name === "glorf") {
            return new Provider("glorf", 'json', "glorf.json");
        }

        return null;
    }
}