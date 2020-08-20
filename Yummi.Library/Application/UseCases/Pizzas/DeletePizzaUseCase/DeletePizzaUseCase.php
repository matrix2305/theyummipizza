<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Pizzas\DeletePizzaUseCase;


use Yummi\Application\Contracts\Repositories\IPizzasRepository;
use RuntimeException;
use Exception;

class DeletePizzaUseCase
{
    private IPizzasRepository $pizzasRepository;

    public function __construct(IPizzasRepository $pizzasRepository){
        $this->pizzasRepository = $pizzasRepository;
    }

    public function Execute() : void
    {
        if ($id = request()->input('id')){
            try {
                $pizza = $this->pizzasRepository->getOnePizza($id);
                $this->pizzasRepository->deletePizza($pizza);
            }catch (Exception $exception){
                throw new RuntimeException("Pizza is tied for orders, you can't delete this pizza.");
            }
        }else{
            throw new RuntimeException("Request don't have id.");
        }
    }
}