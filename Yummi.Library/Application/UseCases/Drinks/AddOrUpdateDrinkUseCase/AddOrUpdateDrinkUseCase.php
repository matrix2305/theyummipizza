<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Drinks\AddOrUpdateDrinkUseCase;


use RuntimeException;
use Yummi\Application\Contracts\Repositories\IDrinksRepository;
use Yummi\Application\Contracts\UseCases\IAddOrUpdateDrinkUseCase;
use Yummi\Application\UseCases\Drinks\GetDrinksUseCase\GetDrinksOutput;
use Yummi\Domain\Entities\Drink;
use Yummi\Infrastructure\Services\ImageUploader\ImageUpload;

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
            $version = $data->rowVersion;
        }else{
            if (!request()->has('image')){
                throw new RuntimeException('Please upload image of drink!');
            }
            $drink = new Drink();
            $drink->setRowVersion();
            $version = $drink->getRowVersion();
        }
        if (request()->has('image')){
            $imagePath = ImageUpload::Upload('/storage/drinks/', 'image');
            $drink->setImagePath($imagePath);
        }
        $drink->setName($data->name);
        $drink->setPrice($data->price);
        $this->drinksRepository->addOrUpdateDrink($drink, $version);
    }
}