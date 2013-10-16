<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Parser;
use \PlMaikeru\CheckCheckIn\Utils\Parser\GenericParser;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Parser\GenericParser
 *
 */
class GenericParserWithSubparsersShould extends ParserTestCase
{
    private $parser;
    private $subparser1;
    private $subparser2;
    private $subparser3;
    public function setUp()
    {
        parent::setUp();
        $this->parser = $this->getParser();
    }
    protected function getParser()
    {
        $this->subparser1 = m::mock('\PlMaikeru\CheckCheckIn\Utils\Parser\ParserInterface');
        $this->subparser2 = m::mock('\PlMaikeru\CheckCheckIn\Utils\Parser\ParserInterface');
        $this->subparser3 = m::mock('\PlMaikeru\CheckCheckIn\Utils\Parser\ParserInterface');
        $parser = new GenericParser();
        $parser->addSubparser($this->subparser1);
        $parser->addSubparser($this->subparser2);
        $parser->addSubparser($this->subparser3);
        return $parser;
    }
    /**
     * @test
     */
    public function parseUsingSameExecutorOnAllSubparsersWhenHarvestCalled()
    {
        $this->subparser1->shouldReceive('parse')->with($this->executor)->once()->andReturn(array());
        $this->subparser2->shouldReceive('parse')->with($this->executor)->once()->andReturn(array());
        $this->subparser3->shouldReceive('parse')->with($this->executor)->once()->andReturn(array());
        $this->parser->parse($this->executor);
    }
    /**
     * @test
     */
    public function returnResultAsSumOfAllSubparsersResults()
    {
        $this->subparser1->shouldReceive('parse')->andReturn(array('foo'));
        $this->subparser2->shouldReceive('parse')->andReturn(array('bar', 'foo'));
        $this->subparser3->shouldReceive('parse')->andReturn(array('bar', 'baz', 'goo'));
        $expected = array('foo', 'bar', 'foo', 'bar', 'baz', 'goo');
        $this->assertSame($expected, $this->parser->parse($this->executor));
    }
    /**
     * @test
     */
    public function returnEmptyResultIfAllSubparsersReturnedEmptyResult()
    {
        $this->subparser1->shouldReceive('parse')->andReturn(array());
        $this->subparser2->shouldReceive('parse')->andReturn(array());
        $this->subparser3->shouldReceive('parse')->andReturn(array());
        $expected = array();
        $this->assertSame($expected, $this->parser->parse($this->executor));
    }
}