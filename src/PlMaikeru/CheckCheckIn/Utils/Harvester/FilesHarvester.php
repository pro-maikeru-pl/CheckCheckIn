<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor;

class FilesHarvester extends ExecutorAwareComposite
{
    public function process(Executor $executor = null)
    {
        return array_values(array_unique(parent::process($executor)));
    }
}