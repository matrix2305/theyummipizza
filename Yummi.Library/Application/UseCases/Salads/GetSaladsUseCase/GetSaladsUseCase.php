<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Salads\GetSaladsUseCase;


use Yummi\Application\Contracts\Repositories\ISaladsRepository;
use Yummi\Application\Contracts\UseCases\IGetSaladsUseCase;

class GetSaladsUseCase implements IGetSaladsUseCase
{
    private ISaladsRepository $saladsRepository;

    public function __construct(ISaladsRepository $saladsRepository){
        $this->saladsRepository = $saladsRepository;
    }

    public function Execute()
    {
        if ($id = request()->input('id')){
            $salad = $this->saladsRepository->getOneSalad($id);
            return GetSaladsOutput::fromEntity($salad);
        }

        $salads = $this->saladsRepository->getAllSalads();
        return GetSaladsOutput::fromCollection($salads);
    }

}