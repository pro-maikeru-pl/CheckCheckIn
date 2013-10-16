<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Parser;
use \PlMaikeru\CheckCheckIn\Utils\Parser\GenericParser;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Parser\GenericParser
 *
 */
class GenericParserShould extends ParserTestCase
{
    protected function getParser()
    {
        return new GenericParser($this->executor);
    }
    /**
     * @test
     */
    public function haveNoSubParsersInitially()
    {
        $parser = $this->getParser();
        $this->assertCount(0, $parser->getSubparsers());
    }
    /**
     * @test
     */
    public function beAbleToReceiveSubparsers()
    {
        $parser = $this->getParser();
        $subParser1 = $this->getParser();
        $subParser2 = $this->getParser();
        $parser->addSubparser($subParser1);
        $parser->addSubparser($subParser2);
        $expected = array($subParser1, $subParser2);
        $this->assertEquals($expected, $parser->getSubparsers());
    }
    /**
     * @test
     */
    public function ignoreDuplicatedSubparsers()
    {
        $parser = $this->getParser();
        $subParser1 = $this->getParser();
        $parser->addSubparser($subParser1);
        $parser->addSubparser($subParser1);
        $parser->addSubparser($subParser1);
        $expected = array($subParser1);
        $this->assertEquals($expected, $parser->getSubparsers());
    }
    /**
     * @test
     */
    public function storeExecutor()
    {
        $parser = $this->getParser();
        $this->assertSame($this->executor, $parser->getExecutor());
    }
    /**
     * @test
     */
    public function useCustomExecutorWhenPassedWhileGettingOne()
    {
        $newExecutor = m::mock('\PlMaikeru\CheckCheckIn\Utils\Executor\Executor');
        $parser = $this->getParser();
        $this->assertSame($newExecutor, $parser->getExecutor($newExecutor));
    }
}
