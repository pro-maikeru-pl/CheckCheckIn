<?php
namespace PlMaikeru\CheckCheckIn\Utils;

class Executor
{
    private $output;
    private $returnCode;
    private $command;
    public function exec($command)
    {
        $this->resetValues($command);
        $this->execute();
        $this->throwExceptionIfError();
        return $this->output;
    }
    private function resetValues($command)
    {
        $this->output = array();
        $this->returnCode = 0;
        $this->command = $command . " 2>&1";
    }
    private function execute()
    {
        exec($this->command, $this->output, $this->returnCode);
    }
    private function throwExceptionIfError()
    {
        if ($this->returnCode !== 0) {
            throw new \RuntimeException($this->prepareExceptionMessage($this->command, $this->output));
        }
    }
    private function prepareExceptionMessage($command, array $output)
    {
        return 'Error when executing command ' . $command . '. RESULT: ' . var_export($output, true);
    }
}