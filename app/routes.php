<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*Event::listen('illuminate.query', function($sql, $bindings, $time){
    echo $sql;          // select * from my_table where id=? 
    print_r($bindings); // Array ( [0] => 4 )
    echo $time;         // 0.58 

    // To get the full sql query with bindings inserted
    $sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
    $full_sql = vsprintf($sql, $bindings);
});*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('login', 'SessionsController@create');

Route::get('logout', 'SessionsController@destroy');

Route::get('/taluk.php/{district_id?}', 'UsersController@taluk');

Route::get('/hobli.php/{taluk_id?}', 'UsersController@hobli');

Route::get('/manufacturer.php/{product_id?}', 'UsersController@manufacturer');

Route::get('/model.php/{manufacturer_id?}', 'UsersController@model');

Route::get('/specificaton.php/{model_id?}', 'UsersController@specificaton');

Route::get('/rateShare.php/{spec_id?}/{model_id?}/{manufacturer_id?}/{product_id?}', 'UsersController@rateShare');

Route::get('/age.php/{dob?}', 'UsersController@age');

//

Route::resource('users', 'UsersController');

Route::get('/users-list', 'BeneficiaryController@usersList');



Route::post('/users-list', 'BeneficiaryController@usersList');

//Ajax call for validation and fetching data
Route::get('/product/{ids?}', 'UsersController@productDetails');

Route::get('/dcnumber-check', 'BeneficiaryController@dcNumberCheck');

//END

/*Route::get('/orders/{id?}', 'UsersController@orders');

Route::post('/orders', 'UsersController@orders');*/

Route::post('/registration', 'UsersController@registration');

Route::resource('sessions', 'SessionsController'); 

Route::get('login-details-mail', 'HomeController@loginDetailsMail');



