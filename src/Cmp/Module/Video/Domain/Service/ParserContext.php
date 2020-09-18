<?php


namespace Cmp\Module\Video\Domain\Service;


use Cmp\Module\Video\Domain\ParserStrategy;
use Cmp\Module\Video\Domain\Provider;
use Cmp\Module\Video\Domain\Videos;

class ParserContext
{
    public const JSON_TYPE = 'json';
    public const YML_TYPE = 'yml';

    private $strategies = [];

    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
    }

    public function __invoke(Provider $provider): Videos
    {
        $videos = null;
        array_walk($this->strategies, function (ParserStrategy $strategy) use ($provider, &$videos) {
            if ($strategy->isApplicable($provider)) {
                $videos = $strategy->parse($provider->filenameToImport());
            }
        });

        return $videos;
    }
}