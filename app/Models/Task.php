<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 07 Jan 2019 12:13:12 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Task
 * 
 * @property int $task_idx
 * @property string $title
 * @property string $content
 * @property \Carbon\Carbon $write_at
 * @property \Carbon\Carbon $modify_at
 * @property int $user_idx
 * 
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Task extends Eloquent
{
	protected $primaryKey = 'task_idx';
	public $timestamps = false;

	protected $casts = [
		'user_idx' => 'int'
	];

	protected $dates = [
		'write_at',
		'modify_at'
	];

	protected $fillable = [
		'title',
		'content',
		'write_at',
		'modify_at',
		'user_idx',
        'check_yn'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'user_idx');
	}
}
