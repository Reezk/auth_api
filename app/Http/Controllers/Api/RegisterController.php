<?php

namespace App\Http\Controllers\Api;


use App\Request\Users\CreateUserValidator;
use App\Services\UserServices;

class RegisterController extends BaseController
{
    public UserServices $userService;
    public function __construct(UserServices $userService)
    {
        $this->userService = $userService;
    }
    public function register(CreateUserValidator $createUserValidator)
    {
        if (!empty($createUserValidator->getErrors())) {
            return response()->json($createUserValidator->getErrors(), 406);
        }
        $user = $this->userService->createUser($createUserValidator->request()->all());
        $message['user'] = $user;
        $message['token'] = $user->createToken('MyApp')->plainTextToken;
        $this->sendResponse($message);
    }
}
