<?php
declare(strict_types=1);
namespace Yummi\Application\UseCases\Salads\DeleteSaladUseCase;


use Exception;
use RuntimeException;
use Yummi\Application\Contracts\Repositories\ISaladsRepository;
use Yummi\Application\Contracts\UseCases\IDeleteSaladUseCase;

class DeleteSaladUseCase implements IDeleteSaladUseCase
{
    private ISaladsRepository $saladsRepository;

    public function __construct(ISaladsRepository $saladsRepository){
        $this->saladsRepository = $saladsRepository;
    }

    public function Execute() : void
    {
        if ($id = request()->input('id')){
            try {
                $salad = $this->saladsRepository->getOneSalad($id);
                $this->saladsRepository->deleteSalad($salad);
            }catch (Exception $exception){
                throw new RuntimeException("Salad is tied for orders, you can't delete this salad.");
            }
        }else{
            throw new RuntimeException("Request don't have id.");
        }
    }
}