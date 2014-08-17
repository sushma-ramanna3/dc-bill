<?php

class SessionsController extends BaseController {


	/**
	 * Show the form for creating a new resource.
	 * user login 
	 * @return Response
	 */

	public function create()
	{
		if (Auth::check()) return Redirect::intended('/users');
	    else return View::make('login');

	    //return View::make('login');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$credentials = array(
		        'email' => Input::get('email'),
		        'password' => Input::get('password')
		    );
		$attempt = Auth::attempt($credentials);
	
	    if ($attempt) {
	        return Redirect::intended('/users');//->with('flash_message', 'You have logged in !');

	    } else {
	        return Redirect::back()->with('flash_message', 'Invalid Credentials')->withInput();
	    }

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();
		return Redirect::to('/login')->with('flash_message', 'You have logged out');
	}

}
