<?php


namespace Cmp\Module\Video\Domain;


use Cmp\Shared\Domain\Collection;

class Videos extends Collection
{
    protected function type(): string
    {
        return Video::class;
    }

    public static function fromJsonArray(array $data): self
    {
        return new self(array_map(function ($video) {
            $title = isset($video['title']) ? $video['title'] : 'no-title';
            $url = isset($video['url']) ? new Url($video['url']) : new Url('no-url');
            $tags = isset($video['tags']) ? Tags::fromArray($video['tags']) : Tags::fromArray([]);

            return new Video($title, $url, $tags);
        }, $data['videos']));
    }

    public static function fromYmlArray(array $data): self
    {
        return new self(array_map(function ($video) {
            $title = isset($video['name']) ? $video['name'] : 'no-title';
            $url = isset($video['url']) ? new Url($video['url']) : new Url('no-url');
            $tags = isset($video['labels']) ? Tags::fromString($video['labels']) : Tags::fromArray([]);

            return new Video($title, $url, $tags);
        }, $data));
    }

    public function print()
    {
        foreach ($this->items() as $item) {
            echo $item;
        }
    }
}