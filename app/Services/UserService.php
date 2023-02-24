<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @param Request $request
     * @return User
     */
    public function create(Request $request):User
    {
       $user = new User();
       $user['username'] =  $request->input('userName');
       $user['phone_number'] =  $request->input('phoneNumber');
       $user['token']  = $this->generateUniqueToken();
       $user['expiry_date'] = Carbon::now()->addDays(7);
       $user->save();

       return $user;
   }

    /**
     * @param string $token
     * @return User
     */
    public function deactivateLink(string $token):User
    {
        $user = User::where('token', $token)->firstOrFail();
        $user->token = null;
        $user->save();

        return $user;
    }

    /**
     * @param string $token
     * @return string
     */
    public function updateToken(string $token):string
    {
        $user = User::where('token', $token)->firstOrFail();
        $user->token = $this->generateUniqueToken();
        $user->expiry_date = Carbon::now()->addDays(7);
        $user->save();

        return $user->token;
    }

    /**
     * @param $token
     * @return User
     */
    public function getUserByToken($token):User
    {
        if(empty($token)) {
            abort(404);
        }

        return User::where('token', $token)->firstOrFail();
    }

    /**
     * @return string
     */
    public function generateUniqueToken():string
    {
        return Str::uuid();
    }

    /**
     * @param string $token
     * @return string
     */
    public function generateLink(string $token):string
    {
        return config('custom.page_url'). $token;
    }

    /**
     * @param $expiryDate
     * @return void
     */
    public function expiryDateCheck($expiryDate):void
    {
        if ($expiryDate < \Carbon\Carbon::now()) {
            abort(401);
        }
    }
}
