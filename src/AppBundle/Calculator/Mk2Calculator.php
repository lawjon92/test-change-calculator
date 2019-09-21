<?php

declare(strict_types=1);

namespace AppBundle\Calculator;

use AppBundle\Model\Change;

class Mk2Calculator implements CalculatorInterface
{
    /**
     * @return string Indicates the model of automaton
     */
    public function getSupportedModel(): string
    {
        return 'mk2';
    }

    /**
     * @param int $amount The amount of money to turn into change
     *
     * @return Change|null The change, or null if the operation is impossible
     */
    public function getChange(int $amount): ?Change
    {
        $change = new Change();

        //Calculate number of 10 bill
        $change->bill10 = intval($amount / 10);
        $amount = $amount % 10;

        //Calculate number of 5 bill
        $change->bill5 = intval($amount / 5);
        $amount = $amount % 5;

        //Calculate number of 2 coins
        $change->coin2 = intval($amount / 2);
        $amount = $amount % 2;

        if (0 === $amount) {
            return $change;
        }

        return null;
    }
}
