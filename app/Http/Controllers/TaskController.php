<?php

namespace App\Http\Controllers;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PDOException;
use Exception;

class TaskController extends Controller
{
    //

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function write(Request $request){




        $user_idx = $request->get('user_idx');
        $title = $request->get('title');
        $content = $request->get('content');


        $response = [];
        try {
            $this->validate($request, [
                'user_idx' => 'nullable',
                'title' => 'required|max:100',
                'content' => 'required',
            ]);

            $this->taskService->write($user_idx, $title, $content);

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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {




        $title = $request->get('title');
        $content = $request->get('content');
        $task_idx = $request->get('task_idx');

        $response= [];

        try {
            $this->validate($request, [
                'task_idx' => 'nullable',
                'title' => 'required|max:100',
                'content' => 'required',
            ]);
            $this->taskService->update($task_idx, $title, $content);

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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function delete(Request $request)
    {


        $task_idx = $request->get('task_idx');

        $response = [];
        try {
            $this->validate($request, [
                'task_idx' => 'nullable',
            ]);

            $this->taskService->delete($task_idx);

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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Http\JsonResponse|string
     */
    public function index(Request $request)
    {

        $response = [];

        try{
            $this->validate($request, [
                'task_idx' => 'nullable',
            ]);
           # $task = DB::table('tasks')->paginate(15);
             $task=$this->taskService->index();

            $response['code'] = 200;
            $response['msg'] = 'ok';

        }catch (PDOException $e){
            $response['code'] = $e->getCode();
            $response['msg'] = $e->getMessage();
            return Response::json($response);
        }catch (Exception $e){

            return $e->getMessage();
        }

        return  $task;
    }

}
