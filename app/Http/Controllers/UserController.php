<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use Illuminate\Contracts\Foundation\Application;
use App\Services\UserService;
use Illuminate\View\View;


class UserController extends Controller
{
    public function index():View
    {
        return view('registration');
    }

    /**
     * @param RegistrationFormRequest $request
     * @param UserService $userService
     * @return View
     */
    public function registration(RegistrationFormRequest $request, UserService $userService):View
    {
        $user = $userService->create($request);
        $link = $userService->generateLink($user->token);

        return view('link',['link' => $link]);
    }
}
