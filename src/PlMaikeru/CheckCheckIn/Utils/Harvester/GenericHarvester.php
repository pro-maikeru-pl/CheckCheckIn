<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor,
    \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite;

class GenericHarvester extends ExecutorAwareComposite implements HarvesterInterface
{
    public function addSubcomponent(HarvesterInterface $subharvester)
    {
        return parent::addSubcomponent($subharvester);
    }



}