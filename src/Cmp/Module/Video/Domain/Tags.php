<?php


namespace Cmp\Module\Video\Domain;


use Cmp\Shared\Domain\Collection;

class Tags extends Collection
{
    protected function type(): string
    {
        return Tag::class;
    }

    public function toString(): String
    {
        return implode($this->items(), ",");
    }

    public static function fromArray(array $data): self
    {
        return new self(array_map(function ($tag) {

            return new Tag($tag);
        }, $data));
    }

    public static function fromString(String $tags): self
    {
        $dataArray = explode(",", str_replace(" ", "", $tags));

        return new self(array_map(function ($tag) {

            return new Tag($tag);
        }, $dataArray));
    }
}