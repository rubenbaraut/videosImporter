<?php

namespace Cmp\Tests;


use Cmp\Module\Video\Domain\Exception\FileException;
use Cmp\Module\Video\Domain\ParserYmlStrategy;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Parser;

class ParserYmlStrategyTest extends TestCase
{
    private $handler;

    protected function setUp()
    {
        $parser = new Parser();
        $feedPath = 'feed-exports/';
        $this->handler = new ParserYmlStrategy($feedPath, $parser);
    }

    /** @test */
    public function it_should_throw_file_not_found_exception_if_file_not_exist()
    {
        $filename = 'notExist.yml';
        $this->expectException(FileException::class);
        $this->handler->parse($filename);
    }

    /** @test */
    public function it_should_read_file_if_file_exist()
    {
        $filename = 'flub.yaml';
        $result = $this->handler->parse($filename);
        $items = $result->items();

        $this->assertEquals($items[0]->url()->value(), 'http://glorf.com/videos/asfds.com');
        $this->assertEquals($items[0]->title(), 'funny cats');
        $this->assertEquals($items[0]->tags()->toString(), 'cats,cute,funny');

        $this->assertEquals($items[1]->url()->value(), 'http://glorf.com/videos/asdfds.com');
        $this->assertEquals($items[1]->title(), 'more cats');
        $this->assertEquals($items[1]->tags()->toString(), 'cats,ugly,funny');

        $this->assertEquals($items[2]->url()->value(), 'http://glorf.com/videos/asasddfds.com');
        $this->assertEquals($items[2]->title(), 'lots of dogs');
        $this->assertEquals($items[2]->tags()->toString(), 'dogs,cute,funny');

        $this->assertEquals($items[3]->url()->value(), 'http://glorf.com/videos/q34343.com');
        $this->assertEquals($items[3]->title(), 'bird dance');
        $this->assertEquals($items[3]->tags()->toString(), '');
    }

}
