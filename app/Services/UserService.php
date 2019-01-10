<?php
/**
 * Created by PhpStorm.
 * User: paikgyeongjun
 * Date: 2019-01-07
 * Time: 21:16
 */

namespace App\Services;


use App\Exceptions\UserException;
use App\Repo\UserRepo;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @param $email
     * @param $pw
     */
    public function register($email, $pw)
    {
        $this->userRepo->insert($email, $pw);
    }

    /**
     * @param $email
     * @param $pw
     * @return void
     * @throws Exception
     */
    public function login($email, $pw)
    {
        $user = $this->userRepo->user($email)->first();

        $hashed_pw = $user->passwd;
     #   echo($hashed_pw);

        unset($user->passwd);

        if (Hash::check($pw, $hashed_pw)) {
            session(['user'=>$user]);
        } else {
            throw new UserException('pw not equal',201);
        }

    }

    /**
     * @param $email
     * @throws UserException
     */
    public function logout($email)
    {
        $user = $this->userRepo->user_out($email);
        echo($user);
        if($user){
            session_abort();
        }else{
            throw new UserException('no login',201);
        }
    }
}
