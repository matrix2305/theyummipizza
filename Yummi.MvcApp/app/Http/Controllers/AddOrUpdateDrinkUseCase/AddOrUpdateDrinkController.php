<?php
declare(strict_types=1);
namespace App\Http\Controllers\AddOrUpdateDrinkUseCase;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Yummi\Application\Contracts\UseCases\IAddOrUpdateDrinkUseCase;

class AddOrUpdateDrinkController extends Controller
{
    private IAddOrUpdateDrinkUseCase $addOrUpdateDrinkUseCase;

    public function __construct(IAddOrUpdateDrinkUseCase $addOrUpdateDrinkUseCase){
        $this->addOrUpdateDrinkUseCase = $addOrUpdateDrinkUseCase;
    }

    public function Execute(Request $request)
    {
        $request->validate([
           'name' => 'required|string:20',
           'price' => 'required|max:10'
        ]);

        try {
            $this->addOrUpdateDrinkUseCase->Execute();
            return response()->json(['message'=>'Successful added drink!', 'status' => true]);
        }catch (Exception $exception){
            return response()->json(['message'=> $exception->getMessage(), 'status' => false]);
        }
    }
}
