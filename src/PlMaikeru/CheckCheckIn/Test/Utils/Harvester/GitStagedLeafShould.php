<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use PlMaikeru\CheckCheckIn\Test\Utils\Composite\CompositeTestCase;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\GitStagedLeaf;
use \Mockery as m;

/**
 * Class GitStagedLeafShould.
 *
 * @covers \PlMaikeru\CheckCheckIn\Utils\Harvester\GitStagedLeaf
 * @covers \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComponent
 */
class GitStagedLeafShould extends CompositeTestCase
{
    protected $leaf;
    public function setUp()
    {
        parent::setUp();
        $this->leaf = new GitStagedLeaf();
    }
    /**
     * @test
     */
    public function execCommandListingAllGitStagedFiles()
    {
        $execResult = array('foo');
        $this->executor->shouldReceive('exec')->with('git diff-index --cached --name-only HEAD')->once()->andReturn($execResult);
        $this->assertSame($execResult, $this->leaf->process($this->executor));
    }
    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function throwExceptionIfNoExecutorPassed()
    {
        $this->leaf->process();
    }
}
