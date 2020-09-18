<?php


namespace Cmp\Tests;


use Cmp\Module\Video\Domain\Provider;
use Faker\Factory;

class ProviderStub
{
    public static function create(string $name, string $type, string $file): Provider
    {
        return new Provider($name, $type, $file);
    }

    public static function random(): Provider
    {
        return self::create(
            Factory::create()->name,
            Factory::create()->name,
            Factory::create()->name . ".json"
        );
    }
}