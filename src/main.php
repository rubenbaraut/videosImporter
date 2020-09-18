<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Cmp\Application;
use Cmp\Module\Video\Application\VideosPersister;
use Cmp\Module\Video\Domain\ParserJsonStrategy;
use Cmp\Module\Video\Domain\ParserYmlStrategy;
use Cmp\Module\Video\Domain\Service\ParserContext;
use Cmp\Module\Video\Infrastructure\FakeProviderRepository;
use Cmp\Module\Video\Infrastructure\FakeVideoRepository;
use Symfony\Component\Yaml\Parser;


$feedPath = 'feed-exports/';
$strategies = [
    new ParserJsonStrategy($feedPath),
    new ParserYmlStrategy($feedPath, new Parser())
];

$application = new Application(
    new FakeProviderRepository(),
    new ParserContext($strategies),
    new VideosPersister(new FakeVideoRepository())
);

$application->run($argv[1]);