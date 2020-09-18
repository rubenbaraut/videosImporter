<?php


namespace Cmp\Module\Video\Application;


use Cmp\Module\Video\Domain\Exception\ProviderNotFoundException;
use Cmp\Module\Video\Domain\Provider;
use Cmp\Module\Video\Domain\ProviderRepository;
use Cmp\Module\Video\Domain\Service\ParserContext;
use Cmp\Module\Video\Domain\Videos;

class ImportVideosFromProviderCommandHandle
{
    private $repository;
    private $parser;
    private $persister;

    public function __construct(ProviderRepository $repository, ParserContext $parser, VideosPersister $persister)
    {
        $this->repository = $repository;
        $this->parser = $parser;
        $this->persister = $persister;
    }

    public function __invoke(ImportVideosFromProviderCommand $command): Videos
    {
        $provider = $this->repository->findByName($command->providerName());
        $this->guard($provider);
        $videos = ($this->parser)($provider);
        ($this->persister)($videos);

        return $videos;
    }

    private function guard(?Provider $provider): void
    {
        if (null === $provider) {
            throw new ProviderNotFoundException();
        }
    }
}