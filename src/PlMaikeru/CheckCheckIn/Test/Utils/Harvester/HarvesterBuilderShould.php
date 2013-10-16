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
        $this->executor = m::mock('\PlMaikeru\CheckCheckIn\Utils\Executor\Executor');
        $this->builder = new HarvesterBuilder($this->executor);
    }
    /**
     * @test
     */
    public function createHarvesterListingStagingFiles()
    {
        $harvester = $this->builder->buildGitStaged();
        $this->assertInstanceOf('\PlMaikeru\CheckCheckIn\Utils\Harvester\FilesHarvester', $harvester);
        $subharvesters = $harvester->getSubcomponents();
        $this->assertCount(1, $subharvesters);
        $this->assertInstanceOf('\PlMaikeru\CheckCheckIn\Utils\Harvester\GitStagedLeaf', array_pop($subharvesters));
    }
    /**
     * @test
     */
    public function injectItsExecutorWhileCreatingHarvesters()
    {
        $harvester = $this->builder->buildGitStaged();
        $this->assertSame($this->executor, $harvester->getExecutor());
    }
    /**
     * @test
     */
    public function createHarvesterListingModifiedFiles()
    {
        $harvester = $this->builder->buildGitModified();
        $this->assertInstanceOf('\PlMaikeru\CheckCheckIn\Utils\Harvester\FilesHarvester', $harvester);
        $subharvesters = $harvester->getSubcomponents();
        $this->assertCount(1, $subharvesters);
        $this->assertInstanceOf('\PlMaikeru\CheckCheckIn\Utils\Harvester\GitModifiedLeaf', array_pop($subharvesters));
    }
    /**
     * @test
     */
    public function createHarvesterListingModifiedOrStagedFiles()
    {
        $harvester = $this->builder->buildGitModifiedAndStaged();
        $this->assertInstanceOf('\PlMaikeru\CheckCheckIn\Utils\Harvester\FilesHarvester', $harvester);
        $subharvesters = $harvester->getSubcomponents();
        $this->assertCount(2, $subharvesters);
        $this->assertInstanceOf('\PlMaikeru\CheckCheckIn\Utils\Harvester\GitStagedLeaf', array_pop($subharvesters));
        $this->assertInstanceOf('\PlMaikeru\CheckCheckIn\Utils\Harvester\GitModifiedLeaf', array_pop($subharvesters));
    }
}

