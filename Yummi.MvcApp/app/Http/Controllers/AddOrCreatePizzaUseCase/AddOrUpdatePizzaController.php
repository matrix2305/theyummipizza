<?php
declare(strict_types=1);
namespace App\Http\Controllers\AddOrUpdatePizzaUseCase;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yummi\Application\Contracts\UseCases\IAddOrUpdatePizzaUseCase;

class AddOrUpdatePizzaController extends Controller
{
    private IAddOrUpdatePizzaUseCase $addOrCreatePizzaUseCase;

    public function __construct(IAddOrUpdatePizzaUseCase $addOrCreatePizzaUseCase){
        $this->addOrCreatePizzaUseCase = $addOrCreatePizzaUseCase;
        $this->middleware(['auth:api']);
    }

    public function Execute(Request $request): ?JsonResponse
    {
        $request->validate([
           'name' => 'required|string:30',
           'description' => 'required|string',
           'price' => 'required'
        ]);

        try {
            $this->addOrCreatePizzaUseCase->Execute();
            return response()->json(['message' => 'Successful added pizza!', 'status' => true]);
        }catch (Exception $exception){
            return response()->json(['message' => $exception->getMessage(), 'status' => false]);
        }
    }
}
