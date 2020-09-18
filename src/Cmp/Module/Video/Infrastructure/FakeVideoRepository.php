<?php


namespace Cmp\Module\Video\Infrastructure;


use Cmp\Module\Video\Domain\Video;
use Cmp\Module\Video\Domain\VideoRepository;

class FakeVideoRepository implements VideoRepository
{

    public function save(Video $video): void
    {
        return;
    }
}