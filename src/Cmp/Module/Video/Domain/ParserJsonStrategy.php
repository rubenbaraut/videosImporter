<?php

namespace Cmp\Module\Video\Domain;


use Cmp\Module\Video\Domain\Exception\FileException;
use Cmp\Module\Video\Domain\Service\ParserContext;
use Throwable;

class ParserJsonStrategy implements ParserStrategy
{
    private $path;

    public function __construct(String $path)
    {
        $this->path = $path;
    }

    public function path(): String
    {
        return $this->path;
    }

    public function isApplicable(Provider $provider): bool
    {
        return $provider->feedType() === ParserContext::JSON_TYPE;
    }

    public function parse(String $filename): Videos
    {
        try {
            $file = $this->path() . $filename;
            $string = file_get_contents($file);
            $data = json_decode($string, true);

            return Videos::fromJsonArray($data);

        } catch (Throwable $ex) {
            throw new FileException($ex->getCode());
        }
    }
}