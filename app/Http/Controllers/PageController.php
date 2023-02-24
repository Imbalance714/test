<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageFormRequest;
use App\Services\ResultService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * @param UserService $userService
     * @param string $token
     * @return View
     */
    public function showPage(UserService $userService, string $token): View
    {
        $user = $userService->getUserByToken($token);
        $userService->expiryDateCheck($user);

        return view('page', $user);
    }

    /**
     * @param PageFormRequest $request
     * @param UserService $userService
     * @return View
     */
    public function generateNewLinkAction(PageFormRequest $request, UserService $userService): View
    {

        $user = $userService->getUserByToken($request->token);
        $userService->expiryDateCheck($user);
        $token = $userService->updateToken($request->token);
        $link = $userService->generateLink($token);

        return view('link',['link' => $link]);
    }


    /**
     * @param PageFormRequest $request
     * @param UserService $userService
     * @return RedirectResponse
     */
    public function deactivateLinkAction(PageFormRequest $request, UserService $userService): RedirectResponse
    {
       $user = $userService->getUserByToken($request->token);
       $userService->expiryDateCheck($user->expiry_date);
       $userService->deactivateLink($request->token);

       return to_route('main');
    }

    /**
     * @param PageFormRequest $request
     * @param UserService $userService
     * @param ResultService $resultService
     * @return View
     */
    public function imfeelingLuckyAction(PageFormRequest $request, UserService $userService, ResultService $resultService): View
    {
        $user = $userService->getUserByToken($request->token);
        $userService->expiryDateCheck($user->expiry_date);
        $result = $resultService->doLottery($user->id);

        return view('page', ['token' => $user->token, 'result' => $result]);
    }

    /**
     * @param PageFormRequest $request
     * @param UserService $userService
     * @param ResultService $resultService
     * @return View
     */
    public function historyAction(PageFormRequest $request, UserService $userService, ResultService $resultService): View
    {
        $user = $userService->getUserByToken($request->token);
        $userService->expiryDateCheck($user->expiry_date);
        $history = $resultService->getHistory($user->id);

        return view('page', ['token' => $user->token, 'history' => $history]);
    }
}
