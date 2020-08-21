<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Yummi\Application\Contracts\UseCases\IAddOrUpdateUserUseCase;
use Yummi\Application\Contracts\UseCases\IGetUsersUseCase;
use Yummi\Application\UseCases\Users\GetUsersUseCase\GetUsersOutput;

class AuthController extends Controller
{
    private IGetUsersUseCase $GetUsersUseCase;
    private IAddOrUpdateUserUseCase $AddOrUpdateUserUseCase;

    public function __construct(IGetUsersUseCase $GetUsersUseCase){
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->GetUsersUseCase = $GetUsersUseCase;

    }

    public function login(Request $request)
    {
        var_dump($request->all());
//        try {
//            $user = $this->GetUsersUseCase->Execute($request->input('username'));
//            $field_type = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL)? 'email' : 'username';
//            $request->merge([$field_type => $request->input('username')]);
//            $credentials = array_merge($request->only([$field_type, 'password']));
//            $remember = $request->has('remember');
//            if ($token = auth()->attempt($credentials, $remember)){
//                return response()->json(['token' => $token, 'user' => $user, 'message' => 'Successfully sing in!', 'status' => true]);
//            }
//            return response()->json(['Unsuccessfully login, wrong password!', 'status' => false]);
//        }catch (Exception $exception){
//            return response()->json(['Unsuccessfully login, wrong username or email!', 'status' => false]);
//        }
    }

    public function me()
    {
        $authUser = Auth::user();
        $user = GetUsersOutput::fromEntity($authUser);
        return response()->json($user);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logout!', 'status' => true]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    private function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string:30',
            'email' => 'required|string:80|email',
            'name' => 'required|string:30',
            'lastName' => 'required|string:50',
            'phone' => 'required|integer|max:14',
            'street' => 'required|string:80',
            'numberOfStreet' => 'required|string:5',
            'town' => 'required|string:30',
            'password' => 'required|confirmed',
        ]);

        try {
            $this->AddOrUpdateUserUseCase->Execute();
            return response()->json(['message' => 'Successfully registration!', 'status' => true]);
        }catch (Exception $exception){
            return response()->json(['message' => 'Unsuccessfully registration, user is registered with this username or email!', 'status' => false]);
        }
    }
}
