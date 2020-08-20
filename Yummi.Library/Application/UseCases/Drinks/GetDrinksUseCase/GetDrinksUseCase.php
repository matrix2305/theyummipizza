<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Drinks\GetDrinksUseCase;


use Yummi\Application\Contracts\Repositories\IDrinksRepository;

class GetDrinksUseCase
{
    private IDrinksRepository $drinksRepository;

    public function __construct(IDrinksRepository $drinksRepository){
        $this->drinksRepository = $drinksRepository;
    }

    public function Execute($id = null)
    {
        if ($id){
            $drink = $this->drinksRepository->getOneDrink($id);
            return GetDrinksOutput::fromEntity($drink);
        }
        $drinks = $this->drinksRepository->getAllDrinks();
        return GetDrinksOutput::fromCollection($drinks);
    }
}