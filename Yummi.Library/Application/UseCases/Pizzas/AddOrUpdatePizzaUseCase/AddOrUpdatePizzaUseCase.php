<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Pizzas\AddOrUpdatePizzaUseCase;


use Yummi\Application\Contracts\Repositories\IPizzasRepository;
use Yummi\Application\Contracts\UseCases\IAddOrUpdatePizzaUseCase;
use Yummi\Application\UseCases\Pizzas\GetPizzasUseCase\GetPizzasOutput;
use Yummi\Domain\Entities\Pizza;
use RuntimeException;
use ReflectionException;
use Yummi\Domain\Entities\Price;
use Yummi\Domain\Enum\Size;
use Yummi\Infrastructure\Services\ImageUploader\ImageUpload;

class AddOrUpdatePizzaUseCase implements IAddOrUpdatePizzaUseCase
{
    private IPizzasRepository $pizzasRepository;

    public function __construct(IPizzasRepository $pizzasRepository) {
        $this->pizzasRepository = $pizzasRepository;
    }

    public function Execute() : void
    {
        $data = GetPizzasOutput::fromRequest();
        if ($data->price['cm24'] === 0 || $data->price['cm32'] === 0 || $data->price['cm50'] === 0){
            throw new RuntimeException("You aren't insert all prices.");
        }
        if (!empty($data->id)){
            $pizza = $this->pizzasRepository->getOnePizza($data->id);
            $pizza->clear();
            $version = $data->rowVersion;
        }else{
            if (!request()->has('image')){
                throw new RuntimeException('Please upload image of pizza!');
            }
            $pizza = new Pizza();
            $pizza->setRowVersion();
            $version = $pizza->getRowVersion();
        }
        $pizza->setName($data->name);
        if (request()->has('image')){
            $imagePath = ImageUpload::Upload('/storage/pizzas/', 'image');
            $pizza->setImagePath($imagePath);
        }

        $pizza->setDescription($data->description);

        $price = new Price();
        $price->setPrice((int)$data->price['cm24']);
        try {
            $size = new Size(0);
        } catch (ReflectionException $e) {
            throw new RuntimeException("Size isn't compatibility.");
        }
        $price->setSize($size);
        $pizza->setPrice($price);

        $price = new Price();
        $price->setPrice((int)$data->price['cm32']);
        try {
            $size = new Size(1);
        } catch (ReflectionException $e) {
            throw new RuntimeException("Size isn't compatibility.");
        }
        $price->setSize($size);
        $pizza->setPrice($price);

        $price = new Price();
        $price->setPrice((int)$data->price['cm50']);
        try {
            $size = new Size(2);
        } catch (ReflectionException $e) {
            throw new RuntimeException("Size isn't compatibility.");
        }
        $price->setSize($size);
        $pizza->setPrice($price);


        $this->pizzasRepository->addOrUpdatePizza($pizza, $version);
    }
}