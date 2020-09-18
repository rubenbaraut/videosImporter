<?php

namespace Cmp\Tests;


use Cmp\Module\Video\Application\ImportVideosFromProviderCommand;
use Cmp\Module\Video\Application\ImportVideosFromProviderCommandHandle;
use Cmp\Module\Video\Application\VideosPersister;
use Cmp\Module\Video\Domain\Exception\ProviderNotFoundException;
use Cmp\Module\Video\Domain\ParserJsonStrategy;
use Cmp\Module\Video\Domain\ParserYmlStrategy;
use Cmp\Module\Video\Domain\Service\ParserContext;
use Cmp\Module\Video\Domain\Tags;
use Cmp\Module\Video\Domain\Url;
use Symfony\Component\Yaml\Parser;

class ImportProviderCommandHandleTest extends CmpTestCase
{
    private $handler;
    private $feedPath;

    protected function setUp()
    {
        $this->feedPath = 'feed-exports/';
        $jsonStrategy = new ParserJsonStrategy($this->feedPath);
        $ymlStrategy = new ParserYmlStrategy($this->feedPath, new Parser());
        $strategies = [$jsonStrategy, $ymlStrategy];

        $this->handler = new ImportVideosFromProviderCommandHandle(
            $this->providerRepository(),
            new ParserContext($strategies),
            new VideosPersister($this->videoRepository())
        );
    }

    /** @test */
    public function it_should_throw_exception_if_provider_does_not_exist()
    {
        $command = new ImportVideosFromProviderCommand("providerName");

        $this->shouldFindProviderByName("providerName", null);
        $this->expectException(ProviderNotFoundException::class);

        ($this->handler)($command);
    }

    /** @test */
    public function it_should_read_yml_file_if_provider_feed_type_is_yml()
    {
        $this->expectNotToPerformAssertions();
        $command = new ImportVideosFromProviderCommand("companyName");
        $provider = ProviderStub::create("companyName", "yml", "flub.yaml");
        $video1 = VideoStub::create(
            "funny cats",
            new Url("http://glorf.com/videos/asfds.com"),
            Tags::fromString("cats,cute,funny")
        );

        $video2 = VideoStub::create(
            "more cats",
            new Url("http://glorf.com/videos/asdfds.com"),
            Tags::fromString("cats, ugly,funny")
        );

        $video3 = VideoStub::create(
            "lots of dogs",
            new Url("http://glorf.com/videos/asasddfds.com"),
            Tags::fromString("dogs, cute, funny")
        );

        $video4 = VideoStub::create(
            "bird dance",
            new Url("http://glorf.com/videos/q34343.com"),
            Tags::fromArray([])
        );

        $this->shouldFindProviderByName("companyName", $provider);
        $this->shouldSaveVideo($video1);
        $this->shouldSaveVideo($video2);
        $this->shouldSaveVideo($video3);
        $this->shouldSaveVideo($video4);
        ($this->handler)($command);
    }

    /** @test */
    public function it_should_read_json_file_if_provider_feed_type_is_json()
    {
        $this->expectNotToPerformAssertions();
        $command = new ImportVideosFromProviderCommand("companyName");
        $provider = ProviderStub::create("companyName", "json", "glorf.json");
        $this->shouldFindProviderByName("companyName", $provider);

        $video1 = VideoStub::create(
            "science experiment goes wrong",
            new Url("http://glorf.com/videos/3"),
            Tags::fromArray([
                "microwave",
                "cats",
                "peanutbutter"
            ])
        );

        $video2 = VideoStub::create(
            "amazing dog can talk",
            new Url("http://glorf.com/videos/4"),
            Tags::fromArray([
                "dog",
                "amazing"
            ])
        );

        $this->shouldFindProviderByName("companyName", $provider);
        $this->shouldSaveVideo($video1);
        $this->shouldSaveVideo($video2);
        ($this->handler)($command);
    }

}
