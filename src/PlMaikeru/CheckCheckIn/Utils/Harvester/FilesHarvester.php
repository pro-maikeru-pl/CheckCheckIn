<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor;

class FilesHarvester extends GenericHarvester
{
    public function process(Executor $executor = null)
    {
        return array_values(array_unique(parent::process($executor)));
    }
}