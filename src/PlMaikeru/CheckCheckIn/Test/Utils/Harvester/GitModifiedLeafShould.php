<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Harvester;
use PlMaikeru\CheckCheckIn\Test\Utils\Composite\CompositeTestCase;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\GitModifiedLeaf;
use \Mockery as m;
/**
 * Class GitModifiedLeafShould.
 *
 * @covers \PlMaikeru\CheckCheckIn\Utils\Harvester\GitModifiedLeaf
 * @covers \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComponent
 */
class GitModifiedLeafShould extends CompositeTestCase
{
    protected $leaf;
    public function setUp()
    {
        parent::setUp();
        $this->leaf = new GitModifiedLeaf();
    }
    /**
     * @test
     */
    public function execCommandListingAllGitModifiedFiles()
    {
        $execResult = array('foo');
        $this->executor->shouldReceive('exec')->with('git ls-files --modified')->once()->andReturn($execResult);
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
