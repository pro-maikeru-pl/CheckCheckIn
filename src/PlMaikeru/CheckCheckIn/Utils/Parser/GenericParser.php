<?php
namespace PlMaikeru\CheckCheckIn\Utils\Parser;
use \PlMaikeru\CheckCheckIn\Utils\Executor\Executor,
    \PlMaikeru\CheckCheckIn\Utils\Composite\ExecutorAwareComposite;

class GenericParser extends ExecutorAwareComposite implements ParserInterface
{


    public function process(Executor $executor = null)
    {
        return $this->collectResultsFromSubcomponents($this->getExecutor($executor));
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

    private function collectResultsFromSubcomponents(Executor $executor)
    {
        $result = array();
        foreach ($this->subcomponents as $parser) {
            $result = array_merge($result, $parser->process($executor));
        }
        return $result;
    }


}