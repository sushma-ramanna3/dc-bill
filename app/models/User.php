<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Get the users list based on usertype
	 *
	 * @return string
	 */
	public static function getUserList($list = NULL)
	{
		if($list)
			$franchise_list = array(NULL => '--Select franchise--') + DB::table('users')
							->where('usertype', '!=', 'admin')
							->orderBy('franchise', 'ASC')->lists('franchise', 'id');
		else
			$franchise_list = DB::table('users')->select('franchise')
								->where('usertype', '!=', 'admin')->get();
		
		return $franchise_list;
	}

	public static function getCouponDetails($coupon_code)
	{
		$coupon_row = DB::connection('mysql2')
						->table('jos_awocoupon')
						->select('id', 'num_of_uses', 'coupon_value_type', 'coupon_value', 'discount_type', 'function_type')
						->where('published', 1)
						->where('coupon_code', $coupon_code)
						->where(function($coupon_row)
			            {
			                $coupon_row->orWhere('expiration', NULL)
		                      	->orWhere('expiration', "")
		                      	->orWhere('expiration', '>=', date('Y-m-d'));
			            })->get();

		return $coupon_row;
	}

}
