<?php

namespace App;

use App\Permissions\HasPermissionsTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class FrontUser extends Authenticatable
{
    use Notifiable;
    use HasPermissionsTrait; //Import The Trait

	protected $table = 'front_users';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'birthdate', 'genre', 'country ', 'city', 'profile_image', 'biography', 'user_type', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verified', 'email_token',
    ];
	
	public $rules = [
        'first_name' => 'required|max:255',
		'last_name' => 'required|max:255',
        'email' => 'required|max:255|email|unique:front_users,email|same:confirm_email',
		'password' => 'required|same:confirm_password',
    ];
    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
}
