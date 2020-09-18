<?php

namespace Cmp;


use Cmp\Module\Video\Application\ImportVideosFromProviderCommand;
use Cmp\Module\Video\Application\ImportVideosFromProviderCommandHandle;
use Cmp\Module\Video\Application\VideosPersister;
use Cmp\Module\Video\Domain\Exception\ProviderNotFoundException;
use Cmp\Module\Video\Domain\ProviderRepository;
use Cmp\Module\Video\Domain\Service\ParserContext;
use Throwable;


class Application
{
    private $repository;
    private $parserContext;
    private $videosPersister;

    public function __construct(
        ProviderRepository $repository,
        ParserContext $parserContext,
        VideosPersister $videosPersister
    ) {
        $this->repository = $repository;
        $this->parserContext = $parserContext;
        $this->videosPersister = $videosPersister;
    }

    public function run(string $argument)
    {
        try {
            $command = new ImportVideosFromProviderCommand($argument);
            $handler = new ImportVideosFromProviderCommandHandle(
                $this->repository,
                $this->parserContext,
                $this->videosPersister
            );

            $output = ($handler)($command);
            $output->print();
        } catch (ProviderNotFoundException $ex) {
            echo "Provider Not Exist" . "\n";
        } catch (Throwable $ex) {
            echo "An Error has ocurred" . "\n";
        }
    }
}