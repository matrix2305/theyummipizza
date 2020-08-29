<?php
declare(strict_types=1);

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Yummi\Application\Contracts\UseCases\IGetPizzasUseCase;

class GetPizzasController extends Controller
{
    private IGetPizzasUseCase $getPizzasUseCase;

    public function __construct(IGetPizzasUseCase $getPizzasUseCase){
        $this->getPizzasUseCase = $getPizzasUseCase;
    }

    public function Execute(): JsonResponse
    {
        return response()->json($this->getPizzasUseCase->Execute());
    }
}
