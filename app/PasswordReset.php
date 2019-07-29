<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\HttpFoundation\Request;

class PasswordReset extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'password_resets';

    protected $fillable = [
        'email', 'token'
    ];


    public static function generateAndSaveToken(string $email)
    {

        $token = sha1(time() . 'ssssssssssssssssssss');
        $user = new PasswordReset();
        $user->token = $token;
        $user->email = $email;

        $user->save();

        return $token;

    }
}


