<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor,
    \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite;

class GenericHarvester extends ExecutorAwareComposite implements HarvesterInterface
{
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


    private function collectResultsFromSubcomponents(Executor $executor)
    {
        $result = array();
        foreach ($this->subcomponents as $harvester) {
            $result = array_merge($result, $harvester->process($executor));
        }
        return $result;
    }


}