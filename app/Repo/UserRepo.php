<?php
/**
 * Created by PhpStorm.
 * User: paikgyeongjun
 * Date: 2019-01-07
 * Time: 21:16
 */

namespace App\Repo;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserRepo
{
    /**
     * @param $email
     * @param $pw
     */
    public function insert($email, $pw)
    {
        $user = new User();
        $user->email = $email;
        $user->passwd = Hash::make($pw);
        $user->save();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function user($email){
        return User::where('email',$email);
    }

    /**
     * @param $email
     * @return boolean
     */
    public  function user_out($email)
    {
        echo(session()->isValidId($email));
        return session()->isValidId($email);
    }
}
