<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor;

class GitModifiedLeaf implements HarvesterInterface
{
    public function harvest(Executor $executor)
    {
        return $executor->exec('git ls-files --modified');
    }
}