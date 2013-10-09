<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\GenericHarvester;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Harvester\GenericHarvester
 *
 */
class GenericHarvesterWithSubharvestersAndExecutorShould extends HarvesterTestCase
{
    private $harvester;
    private $subharvester1;
    public function setUp()
    {
        parent::setUp();
        $this->harvester = $this->getHarvester();
    }
    protected function getHarvester()
    {
        $this->subharvester1 = m::mock('\PlMaikeru\CheckCheckIn\Utils\Harvester\HarvesterInterface');
        $harvester = new GenericHarvester($this->executor);
        $harvester->addSubharvester($this->subharvester1);

        return $harvester;
    }
    /**
     * @test
     */
    public function whenHarvestingUseExecutorPassedInConstructorIfNoOtherPassed()
    {
        $this->subharvester1->shouldReceive('harvest')->with($this->executor)->once()->andReturn(array());
        $this->harvester->harvest();
    }
    /**
     * @test
     */
    public function whenHarvestingIgnoreConstructorExecutorIfAnotherPassedToMethod()
    {
        $newExecutor = m::mock('\PlMaikeru\CheckCheckIn\Utils\Executor');
        $this->subharvester1->shouldReceive('harvest')->with($newExecutor)->once()->andReturn(array());
        $this->harvester->harvest($newExecutor);
    }
}
