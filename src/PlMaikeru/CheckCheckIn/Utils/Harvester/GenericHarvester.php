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
        $executor = (null === $executor) ? $this->executor : $executor;
        $result = array();
        foreach ($this->subharvesters as $harvester) {
            $result = array_merge($result, $harvester->harvest($executor));
        }
        return $result;
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