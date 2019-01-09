<?php

namespace App\Http\Controllers;

use App\Exceptions\UserException;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PDOException;
use Exception;

class UserController extends Controller
{
    //
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request){



        $email = $request->get('email');
        $pw = $request->get('pw');
        $response = [];

        try {
            $this->validate($request, [
                'email'  => 'required|email|max:255',
                'pw' => 'required',
            ]);

            $this->userService->register($email, $pw);

            $response['code'] = 200;
            $response['msg'] = 'ok';
        } catch (PDOException $e){
            $response['code'] = $e->getCode();
            $response['msg'] = $e->getMessage();
        } catch (Exception $e){
            $response['code'] = $e->getCode();
            $response['msg'] = $e->getMessage();
        }

        return Response::json($response);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $response = [];

        try {
//            $validator = Validator::make($request->all(),[
//                'email' => ['required','exists:users,email','email'],
//                'pw' => ['required']
//            ]);

            $validator =  $request->validate([
                'email'  => 'required|email|max:255|exists:users,email',
                'pw' => 'required|min:6',
            ]);

            $this->userService->login($validator['email'],$validator['pw']);

            $response['code'] = 200;
            $response['msg'] = 'ok';
        } catch (UserException $e){
            $response['code'] = $e->getCode();
            $response['msg'] = $e->getMessage();
        } catch (PDOException $e){
            $response['code'] = $e->getCode();
            $response['msg'] = $e->getMessage();
        } catch (Exception $e){
            $response['code'] = $e->getCode();
            $response['msg'] = $e->getMessage();
        }

        return Response::json($response);
    }
}
