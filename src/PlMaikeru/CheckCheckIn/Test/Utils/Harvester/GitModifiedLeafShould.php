<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\GitModifiedLeaf;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Harvester\GitModifiedLeaf
 *
 */
class GitModifiedLeafShould extends HarvesterTestCase
{
    protected function getHarvester()
    {
        return new GitModifiedLeaf();
    }
    /**
     * @test
     */
    public function execCommandListingAllGitModifiedFiles()
    {
        $execResult = array('foo');
        $this->executor->shouldReceive('exec')->with('git ls-files --modified')->once()->andReturn($execResult);
        $this->assertSame($execResult, $this->getHarvester()->harvest($this->executor));

    }
    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function throwExceptionIfNoExecutorPassed()
    {
        $this->getHarvester()->harvest();
    }
}
