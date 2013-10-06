<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor;

class GitStagedHarvester extends GenericHarvester
{
    public function harvest(Executor $executor)
    {
        return $executor->exec('git diff-index --cached --name-only HEAD');
    }
}