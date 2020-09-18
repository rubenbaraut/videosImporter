<?php


namespace Cmp\Module\Video\Domain;


interface VideoRepository
{
    public function save(Video $video): void;
}