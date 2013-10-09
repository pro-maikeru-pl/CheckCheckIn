<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\FilesHarvester;

class HarvesterBuilder
{
//    private $executor;
//    public function __construct(Executor $executor)
//    {
//        $this->executor = $executor;
//    }
    public function buildGitStaged()
    {
        return new FilesHarvester();
    }
}