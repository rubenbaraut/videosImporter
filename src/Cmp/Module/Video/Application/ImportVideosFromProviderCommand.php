<?php


namespace Cmp\Module\Video\Application;


class ImportVideosFromProviderCommand
{
    private $providerName;

    public function __construct(String $providerName)
    {
        $this->providerName = $providerName;
    }

    public function providerName(): String
    {
        return $this->providerName;
    }
}