<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 07 Jan 2019 12:13:12 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $user_idx
 * @property string $email
 * @property string $passwd
 * @property \Carbon\Carbon $sign_up
 * @property \Carbon\Carbon $last_login
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tasks
 *
 * @package App\Models
 */
class User extends Eloquent
{
	protected $primaryKey = 'user_idx';
	public $timestamps = false;

	protected $dates = [
		'sign_up',
		'last_login'
	];

	protected $fillable = [
		'email',
		'passwd',
		'sign_up',
		'last_login'
	];

	public function tasks()
	{
		return $this->hasMany(\App\Models\Task::class, 'user_idx');
	}
}
