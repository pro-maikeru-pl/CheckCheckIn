<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\GenericHarvester;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Harvester\GenericHarvester
 * @covers \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite
 *
 */
class GenericHarvesterWithSubharvestersShould extends HarvesterTestCase
{
    private $harvester;
    private $subharvester1;
    private $subharvester2;
    private $subharvester3;
    public function setUp()
    {
        parent::setUp();
        $this->harvester = $this->getHarvester();
    }
    protected function getHarvester()
    {
        $this->subharvester1 = m::mock('\PlMaikeru\CheckCheckIn\Utils\Harvester\HarvesterInterface');
        $this->subharvester2 = m::mock('\PlMaikeru\CheckCheckIn\Utils\Harvester\HarvesterInterface');
        $this->subharvester3 = m::mock('\PlMaikeru\CheckCheckIn\Utils\Harvester\HarvesterInterface');
        $harvester = new GenericHarvester();
        $harvester->addComponent($this->subharvester1);
        $harvester->addComponent($this->subharvester2);
        $harvester->addComponent($this->subharvester3);
        return $harvester;
    }
    /**
     * @test
     */
    public function harvestUsingSameExecutorOnAllSubharvestersWhenHarvestCalled()
    {
        $this->subharvester1->shouldReceive('process')->with($this->executor)->once()->andReturn(array());
        $this->subharvester2->shouldReceive('process')->with($this->executor)->once()->andReturn(array());
        $this->subharvester3->shouldReceive('process')->with($this->executor)->once()->andReturn(array());
        $this->harvester->process($this->executor);
    }
    /**
     * @test
     */
    public function returnResultAsSumOfAllSubharvestersResults()
    {
        $this->subharvester1->shouldReceive('process')->andReturn(array('foo'));
        $this->subharvester2->shouldReceive('process')->andReturn(array('bar', 'foo'));
        $this->subharvester3->shouldReceive('process')->andReturn(array('bar', 'baz', 'goo'));
        $expected = array('foo', 'bar', 'foo', 'bar', 'baz', 'goo');
        $this->assertSame($expected, $this->harvester->process($this->executor));
    }
    /**
     * @test
     */
    public function returnEmptyResultIfAllSubharvestersReturnedEmptyResult()
    {
        $this->subharvester1->shouldReceive('process')->andReturn(array());
        $this->subharvester2->shouldReceive('process')->andReturn(array());
        $this->subharvester3->shouldReceive('process')->andReturn(array());
        $expected = array();
        $this->assertSame($expected, $this->harvester->process($this->executor));
    }
}
