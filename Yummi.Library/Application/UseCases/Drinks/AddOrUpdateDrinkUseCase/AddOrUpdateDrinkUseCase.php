<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Drinks\AddOrUpdateDrinkUseCase;


use Yummi\Application\Contracts\Repositories\IDrinksRepository;
use Yummi\Application\Contracts\UseCases\IAddOrUpdateDrinkUseCase;
use Yummi\Application\UseCases\Drinks\GetDrinksUseCase\GetDrinksOutput;
use Yummi\Domain\Entities\Drink;

class AddOrUpdateDrinkUseCase implements IAddOrUpdateDrinkUseCase
{
    private IDrinksRepository $drinksRepository;

    public function __construct(IDrinksRepository $drinksRepository){
        $this->drinksRepository = $drinksRepository;
    }

    public function Execute() : void
    {
        $data = GetDrinksOutput::fromRequest();
        if (!empty($data->id)){
            $drink = $this->drinksRepository->getOneDrink($data->id);
            $version = $data->updatedAt;
        }else{
            $drink = new Drink();
            $version = null;
        }
        $drink->setName($data->name);
        $drink->setImagePath($data->imagePath);
        $drink->setPrice($data->price);
        $this->drinksRepository->addOrUpdateDrink($drink, $version);
    }
}