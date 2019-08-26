<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PasswordReset extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'password_resets';

    protected $fillable = [
        'userType', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function create($request) {
        $password = new PasswordReset();

        $password->email = $request->username;
        $password->userType = $request->userType;
        $password->token = hash_hmac('sha256', $request->username, $request->userType . time());

        if ($password->save())
            return $password->token;

        return false;

    }


    public static function findByToken(string $token){
        $user = self::where('token', $token)->where( 'created_at', '>=', Carbon::now()->subHours(2))->first();

        return $user;
    }
}
