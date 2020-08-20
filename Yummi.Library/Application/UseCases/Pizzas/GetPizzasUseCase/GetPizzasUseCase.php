<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Pizzas\GetPizzasUseCase;


use Yummi\Application\Contracts\Repositories\IPizzasRepository;

class GetPizzasUseCase
{
    private IPizzasRepository $pizzasRepository;

    public function __construct(IPizzasRepository $pizzasRepository) {
        $this->pizzasRepository = $pizzasRepository;
    }

    public function Execute() {
        if ($id = request()->input('id')){
            $pizza = $this->pizzasRepository->getOnePizza($id);
            return GetPizzasOutput::fromEntity($pizza);
        }

        $pizzas = $this->pizzasRepository->getAllPizzas();
        return GetPizzasOutput::fromCollection($pizzas);
    }
}