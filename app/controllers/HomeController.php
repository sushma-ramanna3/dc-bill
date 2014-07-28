<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	//sending login credentials to users by admin in bulk
	
	public function loginDetailsMail(){

		$franchise = DB::table('users')
					->select('franchise')
					->where('usertype', '!=', 'admin')
					->get();

		//$franchise_list[] = array();

		foreach ($franchise as $fran) {
			$franchise_list[] = $fran->franchise;
		}
		//dd($franchise_list);
		$users = DB::connection('mysql2')->table('jos_vm_order_user_info')
					->join('jos_vm_orders', 'jos_vm_orders.order_id', '=', 'jos_vm_order_user_info.order_id')
					->join('jos_users', 'jos_users.email', '=', 'jos_vm_order_user_info.user_email')
					->select('jos_users.name', 'jos_users.email', 'jos_users.username', 'jos_users.switch_pass')
					->whereIn('jos_vm_order_user_info.vm_hearaboutus', $franchise_list)
					->get();
					//dd($users);
		if($users){
			foreach ($users as $key) {
				$name = $key->name;
				$email = $key->email;
				$username = $key->username;
				$password = $key->switch_pass;
			}

			$data = array('name'=>$name, 'username'=>$username, 'password'=>$password);

			Mail::send('emails.credentials', $data, function($message) use ($email)
			{
				$message->from('support@learnwithflip.com', 'Team FLIP');
			    $message->to($email)->subject('User credentials');
			});

			return Redirect::to('users')->with('success', 'Mail has sent.');

		}
		else return Redirect::to('users')->with('warning', 'No users found matching the criteria.');
	}

}
