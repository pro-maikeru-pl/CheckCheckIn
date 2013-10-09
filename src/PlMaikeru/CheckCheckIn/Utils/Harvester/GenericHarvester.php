<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor;

class GenericHarvester implements HarvesterInterface
{
    protected $executor;
    protected $subharvesters;
    
    public function __construct(Executor $executor = null)
    {
        $this->executor = $executor;
        $this->subharvesters = array();
    }

    public function harvest(Executor $executor = null)
    {
        return $this->collectResultsFromSubharvesters($this->getExecutor($executor));
    }

    public function addSubharvester(HarvesterInterface $subharvester)
    {
        foreach ($this->subharvesters as $existing) {
            if ($existing === $subharvester) {
                return;
            }
        }
        $this->subharvesters[] = $subharvester;
    }

    public function getSubharvesters()
    {
        return $this->subharvesters;
    }


    private function getExecutor(Executor $executor = null)
    {
        $result = (null === $executor) ? $this->executor : $executor;
        return $result;
    }
    private function collectResultsFromSubharvesters(Executor $executor)
    {
        $result = array();
        foreach ($this->subharvesters as $harvester) {
            $result = array_merge($result, $harvester->harvest($executor));
        }
        return $result;
    }


}