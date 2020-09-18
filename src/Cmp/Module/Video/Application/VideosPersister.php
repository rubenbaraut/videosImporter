<?php


namespace Cmp\Module\Video\Application;


use Cmp\Module\Video\Domain\VideoRepository;
use Cmp\Module\Video\Domain\Videos;

class VideosPersister
{
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Videos $videos): void
    {
        foreach ($this->iterate($videos) as $video) {
            $this->repository->save($video);
        }
    }

    private function iterate($videos)
    {
        foreach ($videos as $video) {
            yield $video;
        }
    }
}