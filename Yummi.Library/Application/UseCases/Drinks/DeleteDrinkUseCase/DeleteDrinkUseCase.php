<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Drinks\DeleteDrinkUseCase;

use Exception;
use Yummi\Application\Contracts\Repositories\IDrinksRepository;
use RuntimeException;
class DeleteDrinkUseCase
{
    private IDrinksRepository $drinksRepository;

    public function __construct(IDrinksRepository $drinksRepository){
        $this->drinksRepository = $drinksRepository;
    }

    public function Execute() : void
    {
        if ($id = request()->input('id')){
            try {
                $drink = $this->drinksRepository->getOneDrink($id);
                $this->drinksRepository->deleteDrink($drink);
            }catch (Exception $exception){
                throw new RuntimeException("Drink is tied for orders.");
            }
        }else{
            throw new RuntimeException("Request don't have id.");
        }
    }
}