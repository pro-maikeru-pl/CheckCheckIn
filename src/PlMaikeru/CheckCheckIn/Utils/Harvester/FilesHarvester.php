<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor;

class FilesHarvester extends GenericHarvester
{
    public function harvest(Executor $executor)
    {
        return array_values(array_unique(parent::harvest($executor)));
    }
}