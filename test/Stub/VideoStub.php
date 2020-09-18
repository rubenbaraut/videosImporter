<?php


namespace Cmp\Tests;


use Cmp\Module\Video\Domain\Tags;
use Cmp\Module\Video\Domain\Url;
use Cmp\Module\Video\Domain\Video;
use Faker\Factory;

class VideoStub
{
    public static function create(String $title, Url $url, ?Tags $tags): Video
    {
        return new Video($title, $url, $tags);
    }

    public static function random(): Video
    {
        return self::create(
            Factory::create()->word,
            new Url(Factory::create()->url),
            Tags::fromString(implode(Factory::create()->words, ","))
        );
    }
}