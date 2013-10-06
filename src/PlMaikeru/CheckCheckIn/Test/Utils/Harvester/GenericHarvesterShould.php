<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\GenericHarvester;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Harvester\GenericHarvester
 *
 */
class GenericHarvesterShould extends HarvesterTestCase
{
    protected function getHarvester()
    {
        return new GenericHarvester();
    }
    /**
     * @test
     */
    public function haveNoSubharvestersInitially()
    {
        $harvester = $this->getHarvester();
        $this->assertCount(0, $harvester->getSubharvesters());
    }
    /**
     * @test
     */
    public function beAbleToReceiveSubharvesters()
    {
        $harvester = $this->getHarvester();
        $subHarvester1 = $this->getHarvester();
        $subHarvester2 = $this->getHarvester();
        $harvester->addSubharvester($subHarvester1);
        $harvester->addSubharvester($subHarvester2);
        $expected = array($subHarvester1, $subHarvester2);
        $this->assertEquals($expected, $harvester->getSubharvesters());
    }
    /**
     * @test
     */
    public function ignoreDuplicatedSubharvesters()
    {
        $harvester = $this->getHarvester();
        $subHarvester1 = $this->getHarvester();
        $harvester->addSubharvester($subHarvester1);
        $harvester->addSubharvester($subHarvester1);
        $harvester->addSubharvester($subHarvester1);
        $expected = array($subHarvester1);
        $this->assertEquals($expected, $harvester->getSubharvesters());
    }
}
