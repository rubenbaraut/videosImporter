<?php


namespace Cmp\Module\Video\Domain;


use Cmp\Module\Video\Domain\Exception\FileException;
use Cmp\Module\Video\Domain\Service\ParserContext;
use Symfony\Component\Yaml\Parser;
use Throwable;

class ParserYmlStrategy implements ParserStrategy
{
    private $path;
    private $parser;

    public function __construct(String $path, Parser $parser)
    {
        $this->path = $path;
        $this->parser = $parser;
    }

    public function isApplicable(Provider $provider): bool
    {
        return $provider->feedType() === ParserContext::YML_TYPE;
    }

    public function parse(String $filename): Videos
    {
        try {
            $file = $this->path . $filename;
            $data = $this->parser->parseFile($file);

            return Videos::fromYmlArray($data);

        } catch (Throwable $ex) {
            throw new FileException($ex->getMessage());
        }
    }
}