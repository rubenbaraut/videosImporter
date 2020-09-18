<?php


namespace Cmp\Module\Video\Domain;


class Video
{
    private $title;
    private $tags;
    private $url;

    public function __construct(String $title, Url $url, ?Tags $tags)
    {
        $this->title = $title;
        $this->tags = $tags;
        $this->url = $url;
    }

    public function title(): String
    {
        return $this->title;
    }

    public function tags(): ?Tags
    {
        return $this->tags;
    }

    public function url(): Url
    {
        return $this->url;
    }

    public function equals(Video $video): bool
    {
        return $this->title() === $video->title() &&
            $this->tags()->toString() === $video->tags()->toString() &&
            $this->url()->value() === $video->url()->value();
    }

    public function __toString()
    {
        return "Imported: " . $this->title() . "; Url:" . $this->url()->value() . "; Tags:" . $this->tags()->toString() . "\n";
    }
}