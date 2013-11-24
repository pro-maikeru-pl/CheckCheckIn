<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use PlMaikeru\CheckCheckIn\Utils\Composite\Processable;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor,
    \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite;

class GenericHarvester extends ExecutorAwareComposite implements HarvesterInterface
{
    public function addComponent(Processable $subharvester)
    {
        return parent::addComponent($subharvester);
    }



}