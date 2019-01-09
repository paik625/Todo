<?php
/**
 * Created by PhpStorm.
 * User: paikgyeongjun
 * Date: 2019-01-07
 * Time: 21:16
 */

namespace App\Repo;

use DB;
use App\Models\Task;

class TaskRepo
{
    /**
     * @param $title
     * @param $content
     * @param $user_idx
     */
    public function insert($user_idx, $title, $content )
    {
        $task= new Task();

        $task->user_idx= $user_idx;
        $task->title = $title;
        $task->content =$content;

        $task->save();
    }

    /**
     * @param $task_idx
     * @param $title
     * @param $content
     */
    public function update($task_idx, $title, $content){
        $task = Task::find($task_idx);

        $task->title = $title;
        $task->content = $content;
        $task->save();
    }

    /**
     * @param $task_idx
     */
    public function  delete($task_idx)
    {
        $task = Task::find($task_idx);

        $task->delete();
    }

    /**
     *
     */
    public function  index()
    {
        #Task::paginate(15);
        DB::table('tasks')->paginate(15);

    }
}
