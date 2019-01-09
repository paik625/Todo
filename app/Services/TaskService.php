<?php
/**
 * Created by PhpStorm.
 * User: paikgyeongjun
 * Date: 2019-01-07
 * Time: 21:16
 */

namespace App\Services;


use App\Repo\TaskRepo;

class TaskService
{
    protected $taskRepo;

    public function __construct(TaskRepo $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    /**
     * @param $title
     * @param $content
     * @param $user_idx
     */
    public function write($user_idx, $title, $content )
    {
        $this->taskRepo->insert($user_idx, $title,$content);
    }

    /**
     * @param $task_idx
     * @param $title
     * @param $content
     */
    public  function  update($task_idx, $title, $content)
    {
        $this->taskRepo->update($task_idx, $title, $content);
    }

    /**
     * @param $task_idx
     */
    public function  delete($task_idx)
    {
        $this->taskRepo->delete($task_idx);
    }

    public function index()
    {
        $this->taskRepo->index();
    }

}
