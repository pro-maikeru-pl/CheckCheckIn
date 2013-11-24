<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\GenericHarvester;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Harvester\GenericHarvester
 * @covers \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite
 *
 */
class GenericHarvesterShould extends HarvesterTestCase
{
    protected function getHarvester()
    {
        return new GenericHarvester($this->executor);
    }
    /**
     * @test
     */
    public function haveNoSubharvestersInitially()
    {
        $harvester = $this->getHarvester();
        $this->assertCount(0, $harvester->getComponents());
    }
    /**
     * @test
     */
    public function beAbleToReceiveSubharvesters()
    {
        $harvester = $this->getHarvester();
        $subHarvester1 = $this->getHarvester();
        $subHarvester2 = $this->getHarvester();
        $harvester->addComponent($subHarvester1);
        $harvester->addComponent($subHarvester2);
        $expected = array($subHarvester1, $subHarvester2);
        $this->assertEquals($expected, $harvester->getComponents());
    }
    /**
     * @test
     */
    public function ignoreDuplicatedSubharvesters()
    {
        $harvester = $this->getHarvester();
        $subHarvester1 = $this->getHarvester();
        $harvester->addComponent($subHarvester1);
        $harvester->addComponent($subHarvester1);
        $harvester->addComponent($subHarvester1);
        $expected = array($subHarvester1);
        $this->assertEquals($expected, $harvester->getComponents());
    }
    /**
     * @test
     */
    public function storeExecutor()
    {
        $harvester = $this->getHarvester();
        $this->assertSame($this->executor, $harvester->getExecutor());
    }
    /**
     * @test
     */
    public function useCustomExecutorWhenPassedWhileGettingOne()
    {
        $newExecutor = m::mock('\PlMaikeru\CheckCheckIn\Utils\Executor\Executor');
        $harvester = $this->getHarvester();
        $this->assertSame($newExecutor, $harvester->getExecutor($newExecutor));
    }
}
