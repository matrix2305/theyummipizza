<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Pizzas\AddOrUpdatePizzaUseCase;


use Yummi\Application\Contracts\Repositories\IPizzasRepository;
use Yummi\Application\UseCases\Pizzas\GetPizzasUseCase\GetPizzasOutput;
use Yummi\Domain\Entities\Pizza;
use RuntimeException;
use Yummi\Domain\Entities\Price;
use Yummi\Domain\Enum\Size;

class AddOrUpdatePizzaUseCase
{
    private IPizzasRepository $pizzasRepository;

    public function __construct(IPizzasRepository $pizzasRepository) {
        $this->pizzasRepository = $pizzasRepository;
    }

    public function Execute() : void
    {
        $data = GetPizzasOutput::fromRequest();
        if (empty($data->price) || count($data->price) < 3){
            throw new RuntimeException("You aren't insert all prices.");
        }
        if (!empty($data->id)){
            $pizza = $this->pizzasRepository->getOnePizza($data->id);
            $pizza->clear();
            $version = $data->updatedAt;
        }else{
            $pizza = new Pizza();
            $version = null;
        }
        foreach ($data->price as $input){
            $price = new Price();
            $price->setPrice($input['price']);
            $size = new Size((int)$input['size']);
            $price->setSize($size);
            $pizza->setPrice($price);
        }
        $pizza->setName($data->name);
        $pizza->setImagePath($data->imagePath);
        $pizza->setDescription($data->description);
        $this->pizzasRepository->addOrUpdatePizza($pizza, $version);
    }
}