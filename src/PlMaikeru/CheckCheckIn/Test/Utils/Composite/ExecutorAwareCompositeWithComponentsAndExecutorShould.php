<?php
namespace PlMaikeru\CheckCheckIn\Test\Utils\Composite;
use \Mockery as m;
/**
 * @covers \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite
 */
class ExecutorAwareCompositeWithComponentsAndExecutorShould extends CompositeTestCase
{
    private $composite;
    private $component;
    public function setUp()
    {
        parent::setUp();
        $this->composite = $this->getComposite();
    }
    protected function getComposite()
    {
        $composite = parent::getComposite();
        $this->component = m::mock('\PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite');
        $composite->addComponent($this->component);

        return $composite;
    }
    /**
     * @test
     */
    public function useExecutorPassedInConstructorIfNoOtherPassed()
    {
        $this->component->shouldReceive('process')->with($this->executor)->once()->andReturn(array());
        $this->composite->process();
    }
    /**
     * @test
     */
    public function ignoreConstructorExecutorIfAnotherPassedToMethod()
    {
        $newExecutor = m::mock('\PlMaikeru\CheckCheckIn\Utils\Executor\Executor');
        $this->component->shouldReceive('process')->with($newExecutor)->once()->andReturn(array());
        $this->composite->process($newExecutor);
    }
}
