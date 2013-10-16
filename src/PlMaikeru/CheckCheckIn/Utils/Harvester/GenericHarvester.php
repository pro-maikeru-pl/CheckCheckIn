<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor,
    \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite;

class GenericHarvester extends ExecutorAwareComposite implements HarvesterInterface
{
    protected $executor;
    protected $subcomponents;

    public function __construct(Executor $executor = null)
    {
        $this->executor = $executor;
        $this->subcomponents = array();
    }

    public function process(Executor $executor = null)
    {
        return $this->collectResultsFromSubcomponents($this->getExecutor($executor));
    }

    public function addSubharvester(HarvesterInterface $subharvester)
    {
        foreach ($this->subcomponents as $existing) {
            if ($existing === $subharvester) {
                return;
            }
        }
        $this->subcomponents[] = $subharvester;
    }

    public function getSubcomponents()
    {
        return $this->subcomponents;
    }


    public function getExecutor(Executor $executor = null)
    {
        $result = (null === $executor) ? $this->executor : $executor;
        return $result;
    }
    private function collectResultsFromSubcomponents(Executor $executor)
    {
        $result = array();
        foreach ($this->subcomponents as $harvester) {
            $result = array_merge($result, $harvester->process($executor));
        }
        return $result;
    }


}