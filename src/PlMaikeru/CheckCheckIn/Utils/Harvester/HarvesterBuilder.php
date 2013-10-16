<?php
namespace PlMaikeru\CheckCheckIn\Utils\Harvester;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor;
use \PlMaikeru\CheckCheckIn\Utils\Harvester\FilesHarvester;

class HarvesterBuilder
{
    private $executor;
    public function __construct(Executor $executor)
    {
        $this->executor = $executor;
    }

    public function buildGitStaged()
    {
        $harvester = $this->prepareHarvester();
        $harvester->addSubcomponent(new GitStagedLeaf());
        return $harvester;
    }

    public function buildGitModified()
    {
        $harvester = $this->prepareHarvester();
        $harvester->addSubcomponent(new GitModifiedLeaf());
        return $harvester;
    }

    public function buildGitModifiedAndStaged()
    {
        $harvester = $this->prepareHarvester();
        $harvester->addSubcomponent(new GitModifiedLeaf());
        $harvester->addSubcomponent(new GitStagedLeaf());
        return $harvester;
    }

    private function prepareHarvester()
    {
        return new FilesHarvester($this->executor);
    }
}