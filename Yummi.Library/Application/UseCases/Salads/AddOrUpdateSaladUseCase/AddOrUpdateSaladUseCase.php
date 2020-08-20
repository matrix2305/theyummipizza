<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Salads\AddOrUpdateSaladUseCase;


use Yummi\Application\Contracts\Repositories\ISaladsRepository;
use Yummi\Application\UseCases\Salads\GetSaladsUseCase\GetSaladsOutput;
use Yummi\Domain\Entities\Salad;

class AddOrUpdateSaladUseCase
{
    private ISaladsRepository $saladRepository;

    public function __construct(ISaladsRepository $saladsRepository) {
        $this->saladRepository = $saladsRepository;
    }

    public function Execute() : void
    {
        $data = GetSaladsOutput::fromRequest();
        if (!empty($data->id)){
            $salad = $this->saladRepository->getOneSalad($data->id);
            $version = $data->updatedAt;
        }else{
            $salad = new Salad();
            $version = null;
        }
        $salad->setName($data->name);
        $salad->setDescription($data->description);
        $salad->setImagePath($data->imagePath);
        $this->saladRepository->addOrUpdateSalad($salad, $version);
    }
}