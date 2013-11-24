<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use PlMaikeru\CheckCheckIn\Test\Utils\Composite\CompositeTestCase;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\FilesHarvester;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Harvester\FilesHarvester
 *
 */
class FilesHarvesterShould extends CompositeTestCase
{
    protected function getComposite()
    {
        $this->subharvester1 = m::mock('\PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComponent');
        $this->subharvester2 = m::mock('\PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComponent');
        $this->subharvester3 = m::mock('\PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComponent');
        $harvester = new FilesHarvester();
        $harvester->addComponent($this->subharvester1);
        $harvester->addComponent($this->subharvester2);
        $harvester->addComponent($this->subharvester3);
        return $harvester;
    }
    /**
     * @test
     */
    public function returnResultAsDistinctSumOfAllSubharvestersResults()
    {
        $this->subharvester1->shouldReceive('process')->andReturn(array('foo'));
        $this->subharvester2->shouldReceive('process')->andReturn(array('bar', 'foo'));
        $this->subharvester3->shouldReceive('process')->andReturn(array('bar', 'baz', 'goo'));
        $expected = array('foo', 'bar', 'baz', 'goo');
        $this->assertSame($expected, $this->harvester->process($this->executor));
    }



    private $harvester;
    private $subharvester1;
    private $subharvester2;
    private $subharvester3;
    public function setUp()
    {
        parent::setUp();
        $this->harvester = $this->getComposite();
    }
}
