<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor;

class GenericHarvester implements HarvesterInterface
{
    protected $executor;
    protected $subcomponents;

    public function __construct(Executor $executor = null)
    {
        $this->executor = $executor;
        $this->subcomponents = array();
    }

    public function harvest(Executor $executor = null)
    {
        return $this->collectResultsFromSubharvesters($this->getExecutor($executor));
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
    private function collectResultsFromSubharvesters(Executor $executor)
    {
        $result = array();
        foreach ($this->subcomponents as $harvester) {
            $result = array_merge($result, $harvester->harvest($executor));
        }
        return $result;
    }


}