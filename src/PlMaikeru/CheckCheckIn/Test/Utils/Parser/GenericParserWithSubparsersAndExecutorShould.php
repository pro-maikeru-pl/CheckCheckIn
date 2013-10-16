<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Parser;
use \PlMaikeru\CheckCheckIn\Utils\Parser\GenericParser;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Parser\GenericParser
 *
 */
class GenericParserWithSubparsersAndExecutorShould extends ParserTestCase
{
    private $parser;
    private $subparser1;
    public function setUp()
    {
        parent::setUp();
        $this->parser = $this->getParser();
    }
    protected function getParser()
    {
        $this->subparser1 = m::mock('\PlMaikeru\CheckCheckIn\Utils\Parser\ParserInterface');
        $parser = new GenericParser($this->executor);
        $parser->addSubparser($this->subparser1);

        return $parser;
    }
    /**
     * @test
     */
    public function whenHarvestingUseExecutorPassedInConstructorIfNoOtherPassed()
    {
        $this->subparser1->shouldReceive('parse')->with($this->executor)->once()->andReturn(array());
        $this->parser->parse();
    }
    /**
     * @test
     */
    public function whenHarvestingIgnoreConstructorExecutorIfAnotherPassedToMethod()
    {
        $newExecutor = m::mock('\PlMaikeru\CheckCheckIn\Utils\Executor\Executor');
        $this->subparser1->shouldReceive('parse')->with($newExecutor)->once()->andReturn(array());
        $this->parser->parse($newExecutor);
    }
}