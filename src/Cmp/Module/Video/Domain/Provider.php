<?php


namespace Cmp\Module\Video\Domain;


class Provider
{
    private $name;
    private $feedType;
    private $filenameToImport;

    public function __construct(string $name, string $feedType, string $filenameToImport)
    {
        $this->name = $name;
        $this->feedType = $feedType;
        $this->filenameToImport = $filenameToImport;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function feedType(): string
    {
        return $this->feedType;
    }

    public function filenameToImport(): string
    {
        return $this->filenameToImport;
    }
}