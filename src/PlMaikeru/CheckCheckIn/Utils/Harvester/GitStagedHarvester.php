<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor;

class GitStagedHarvester implements HarvesterInterface
{
    public function harvest(Executor $executor)
    {
        return $executor->exec('git diff-index --cached --name-only HEAD');
    }
}