<?php

namespace Cmp\Tests;


use Cmp\Module\Video\Domain\Provider;
use Cmp\Module\Video\Domain\ProviderRepository;
use Cmp\Module\Video\Domain\Video;
use Cmp\Module\Video\Domain\VideoRepository;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;


abstract class CmpTestCase extends TestCase
{
    private $providerRepository;
    private $videoRepository;

    /** @return ProviderRepository|MockInterface */
    protected function providerRepository()
    {
        return $this->providerRepository = $this->providerRepository ?: Mockery::mock(ProviderRepository::class);
    }

    /** @return VideoRepository|MockInterface */
    protected function videoRepository()
    {
        return $this->videoRepository = $this->videoRepository ?: Mockery::mock(VideoRepository::class);
    }

    public function shouldFindProviderByName(string $name, ?Provider $provider)
    {
        return $this->providerRepository()
            ->shouldReceive('findByName')
            ->with($name)
            ->andReturn($provider);
    }

    public function shouldSaveVideo(Video $video)
    {
        return $this->videoRepository()
            ->shouldReceive('save')
            ->with(Mockery::on(function ($argument) use ($video) {
                return $video->equals($argument);
            }))
            ->andReturnNull();
    }
}