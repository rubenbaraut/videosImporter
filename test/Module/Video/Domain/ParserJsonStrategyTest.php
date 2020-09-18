<?php

namespace Cmp\Tests;


use Cmp\Module\Video\Domain\Exception\FileException;
use Cmp\Module\Video\Domain\ParserJsonStrategy;
use PHPUnit\Framework\TestCase;

class ParserJsonStrategyTest extends TestCase
{
    private $handler;

    protected function setUp()
    {
        $feedPath = 'feed-exports/';
        $this->handler = new ParserJsonStrategy($feedPath);
    }

    /** @test */
    public function it_should_throw_file_not_found_exception_if_file_not_exist()
    {
        $filename = 'notExist.json';
        $this->expectException(FileException::class);
        $this->handler->parse($filename);
    }

    /** @test */
    public function it_should_read_file_if_file_exist()
    {
        $filename = 'glorf.json';
        $result = $this->handler->parse($filename);
        $items = $result->items();

        $this->assertEquals($items[0]->url()->value(), 'http://glorf.com/videos/3');
        $this->assertEquals($items[0]->title(), 'science experiment goes wrong');
        $this->assertEquals($items[0]->tags()->toString(), 'microwave,cats,peanutbutter');

        $this->assertEquals($items[1]->url()->value(), 'http://glorf.com/videos/4');
        $this->assertEquals($items[1]->title(), 'amazing dog can talk');
        $this->assertEquals($items[1]->tags()->toString(), 'dog,amazing');
    }

}
