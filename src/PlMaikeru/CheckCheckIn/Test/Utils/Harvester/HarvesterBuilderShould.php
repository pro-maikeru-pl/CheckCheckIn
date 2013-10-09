<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\HarvesterBuilder;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\FilesHarvester;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\GitModifiedLeaf;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\GitStagedLeaf;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Harvester\HarvesterBuilder
 *
 */
class HarvesterBuilderShould extends \PHPUnit_Framework_TestCase
{
    private $builder;
    private $executor;
    public function setUp()
    {
        $this->executor = m::mock('\PlMaikeru\CheckCheckIn\Utils\Executor');
        $this->builder = new HarvesterBuilder($this->executor);
    }
    /**
     * @test
     */
    public function createHarvesterListingStagesFiles()
    {
        $harvester = $this->builder->buildGitStaged();
        $this->assertInstanceOf('\PlMaikeru\CheckCheckIn\Utils\Harvester\FilesHarvester', $harvester);
    }
}
