<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Calculator\CalculatorInterface;
use AppBundle\Model\Change;
use AppBundle\Registry\CalculatorRegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/automaton/{model}/change/{amount}", methods={"GET"})
     *
     * @param string                      $model
     * @param int                         $amount
     * @param CalculatorRegistryInterface $calculatorRegistry
     *
     * @return JsonResponse
     */
    public function __invoke(string $model, int $amount, CalculatorRegistryInterface $calculatorRegistry)
    {
        $calculator = $calculatorRegistry->getCalculatorFor($model);

        if (!$calculator instanceof CalculatorInterface) {
            return $this->json(null, 404);
        }

        $change = $calculator->getChange($amount);
        if ($change instanceof Change) {
            return $this->json($change);
        }

        return $this->json(null, 204);
    }
}
