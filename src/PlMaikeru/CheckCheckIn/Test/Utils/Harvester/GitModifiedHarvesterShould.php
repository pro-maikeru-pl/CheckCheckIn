<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\GitModifiedHarvester;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Harvester\GitModifiedHarvester
 *
 */
class GitModifiedHarvesterShould extends HarvesterTestCase
{
    protected function getHarvester()
    {
        return new GitModifiedHarvester();
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
}
