<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Parser;
use \PlMaikeru\CheckCheckIn\Utils\Parser\GenericParser;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Parser\GenericParser
 * @covers \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite
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
        $parser->addSubcomponent($this->subparser1);
        $parser->addSubcomponent($this->subparser2);
        $parser->addSubcomponent($this->subparser3);
        return $parser;
    }
    /**
     * @test
     */
    public function parseUsingSameExecutorOnAllSubparsersWhenHarvestCalled()
    {
        $this->subparser1->shouldReceive('process')->with($this->executor)->once()->andReturn(array());
        $this->subparser3->shouldReceive('process')->with($this->executor)->once()->andReturn(array());
        $this->subparser2->shouldReceive('process')->with($this->executor)->once()->andReturn(array());
        $this->parser->process($this->executor);
    }
    /**
     * @test
     */
    public function returnResultAsSumOfAllSubparsersResults()
    {
        $this->subparser1->shouldReceive('process')->andReturn(array('foo'));
        $this->subparser2->shouldReceive('process')->andReturn(array('bar', 'foo'));
        $this->subparser3->shouldReceive('process')->andReturn(array('bar', 'baz', 'goo'));
        $expected = array('foo', 'bar', 'foo', 'bar', 'baz', 'goo');
        $this->assertSame($expected, $this->parser->process($this->executor));
    }
    /**
     * @test
     */
    public function returnEmptyResultIfAllSubparsersReturnedEmptyResult()
    {
        $this->subparser1->shouldReceive('process')->andReturn(array());
        $this->subparser2->shouldReceive('process')->andReturn(array());
        $this->subparser3->shouldReceive('process')->andReturn(array());
        $expected = array();
        $this->assertSame($expected, $this->parser->process($this->executor));
    }
}
