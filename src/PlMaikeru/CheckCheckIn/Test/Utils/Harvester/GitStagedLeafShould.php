<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\GitStagedLeaf;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Harvester\GitStagedLeaf
 *
 */
class GitStagedLeafShould extends HarvesterTestCase
{
    protected function getHarvester()
    {
        return new GitStagedLeaf();
    }
    /**
     * @test
     */
    public function execCommandListingAllGitStagedFiles()
    {
        $execResult = array('foo');
        $this->executor->shouldReceive('exec')->with('git diff-index --cached --name-only HEAD')->once()->andReturn($execResult);
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
