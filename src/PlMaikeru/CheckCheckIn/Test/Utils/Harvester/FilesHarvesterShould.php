<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\FilesHarvester;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Harvester\FilesHarvester
 *
 */
class FilesHarvesterShould extends HarvesterTestCase
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
        $harvester = new FilesHarvester();
        $harvester->addSubharvester($this->subharvester1);
        $harvester->addSubharvester($this->subharvester2);
        $harvester->addSubharvester($this->subharvester3);
        return $harvester;
    }
    /**
     * @test
     */
    public function returnResultAsDistinctSumOfAllSubharvestersResults()
    {
        $this->subharvester1->shouldReceive('harvest')->andReturn(array('foo'));
        $this->subharvester2->shouldReceive('harvest')->andReturn(array('bar', 'foo'));
        $this->subharvester3->shouldReceive('harvest')->andReturn(array('bar', 'baz', 'goo'));
        $expected = array('foo', 'bar', 'baz', 'goo');
        $this->assertSame($expected, $this->harvester->harvest($this->executor));
    }
}
