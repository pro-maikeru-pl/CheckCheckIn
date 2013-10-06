<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor;

class GenericHarvester implements HarvesterInterface
{
    private $subharvesters;
    public function __construct()
    {
        $this->subharvesters = new \ArrayObject();
    }
    public function harvest(Executor $executor)
    {
    }
    public function addSubharvester(HarvesterInterface $subharvester)
    {
        foreach ($this->subharvesters as $existing) {
            if ($existing === $subharvester) {
                return;
            }
        }
        $this->subharvesters->append($subharvester);
    }
    public function getSubharvesters()
    {
        return $this->subharvesters;
    }
}