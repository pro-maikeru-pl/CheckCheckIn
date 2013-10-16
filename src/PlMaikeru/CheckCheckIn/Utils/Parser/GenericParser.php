<?php
namespace PlMaikeru\CheckCheckIn\Utils\Parser;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor,
    \PlMaikeru\CheckCheckIn\Utils\Composite\Generic;

class GenericParser extends Generic implements ParserInterface
{
    protected $executor;
    protected $subcomponents;

    public function __construct(Executor $executor = null)
    {
        $this->executor = $executor;
        $this->subcomponents = array();
    }

    public function parse(Executor $executor = null)
    {
        return $this->collectResultsFromSubparsers($this->getExecutor($executor));
    }

    public function addSubparser(ParserInterface $subparser)
    {
        foreach ($this->subcomponents as $existing) {
            if ($existing === $subparser) {
                return;
            }
        }
        $this->subcomponents[] = $subparser;
    }

    public function getSubparsers()
    {
        return $this->subcomponents;
    }


    public function getExecutor(Executor $executor = null)
    {
        $result = (null === $executor) ? $this->executor : $executor;
        return $result;
    }
    private function collectResultsFromSubparsers(Executor $executor)
    {
        $result = array();
        foreach ($this->subcomponents as $parser) {
            $result = array_merge($result, $parser->parse($executor));
        }
        return $result;
    }


}