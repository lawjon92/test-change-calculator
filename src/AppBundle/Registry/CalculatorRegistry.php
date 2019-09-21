<?php

declare(strict_types=1);

namespace AppBundle\Registry;

use AppBundle\Calculator\CalculatorInterface;

class CalculatorRegistry implements CalculatorRegistryInterface
{
    /**
     * @var iterable
     */
    private $calculators;

    public function __construct(iterable $calculators)
    {
        $this->calculators = $calculators;
    }

    /**
     * @param string $model Indicates the model of automaton
     *
     * @return CalculatorInterface|null The calculator, or null if no CalculatorInterface supports that model
     */
    public function getCalculatorFor(string $model): ?CalculatorInterface
    {
        foreach ($this->calculators as $calculator) {
            if ($calculator->getSupportedModel() === $model) {
                return $calculator;
            }
        }

        return null;
    }
}
