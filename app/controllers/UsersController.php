<?php

class UsersController extends BaseController {


	public function __construct()
	{
		$this->beforeFilter('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}

	public function registration()
	{
		
		$rules = array(
		        'first_name' => 'required|min:3|max:80', //|alpha
		        'last_name' => 'required|min:1|max:80',
		        'phone' => 'required|min:10',
		        'highest_qualification'	=> 'required',
		        'work_experience' => 'required',
		        'address'	=> 'required',
		        'state'	=> 'required',
		        'city'	=> 'required',
		        'zip'	=> 'required|min:6'
		);

		
		$validator = Validator::make(Input::all(), $rules);
	
		
		if ( $validator->passes() ) {

		}
		
	}


}
