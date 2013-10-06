<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor;

class GenericHarvester implements HarvesterInterface
{
    private $subharvesters;
    public function __construct()
    {
        $this->subharvesters = array();
    }
    public function harvest(Executor $executor)
    {
        $result = array();
        foreach ($this->subharvesters as $harvester) {
            $result = array_merge($result, $harvester->harvest($executor));
        }
        return array_values(array_unique($result));
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
}