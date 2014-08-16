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

Route::get('/photodownload/{user_id}', 'BeneficiaryController@photoDownload');

Route::get('login', 'SessionsController@create');

Route::get('logout', 'SessionsController@destroy');

Route::get('/taluk.php/{district_id?}', 'UsersController@taluk');

Route::get('/hobli.php/{taluk_id?}', 'UsersController@hobli');

Route::get('/village.php/{village_id?}', 'UsersController@village');

Route::get('/recommendedFrom.php/{recommended_by?}', 'BeneficiaryController@recommendedFrom');

Route::get('/manufacturer.php/{product_id?}', 'UsersController@manufacturer');

Route::get('/model.php/{manufacturer_id?}', 'UsersController@model');

Route::get('/specificaton.php/{model_id?}', 'UsersController@specificaton');

Route::get('/rateShare.php/{spec_id?}/{model_id?}/{manufacturer_id?}/{product_id?}', 'UsersController@rateShare');

Route::get('/age.php/{dob?}', 'UsersController@age');

Route::resource('users', 'UsersController');

Route::get('/users-list', 'BeneficiaryController@usersList');



Route::post('/users-list', 'BeneficiaryController@usersList');

//Ajax call for validation and fetching data
Route::get('/product/{ids?}', 'UsersController@productDetails');

Route::get('/dcnumber-check', 'BeneficiaryController@dcNumberCheck');

//END

Route::get('/beneficiary/{id?}', 'BeneficiaryController@beneficiaryInfo');

Route::post('/registration', 'UsersController@registration');

Route::resource('sessions', 'SessionsController'); 

Route::get('login-details-mail', 'HomeController@loginDetailsMail');

Route::get('pdf', function(){

        Fpdf::AddPage();
        Fpdf::SetFont('Arial','B',16);
        Fpdf::Cell(40,10,'Hello World!');
        Fpdf::Output();
        exit;

});
/*https://gist.github.com/Sentences/3945396*/
Route::get('images/(:any?)', function($image = null)
        {
        	$image = '34_1408115056_Screenshot from 2014-08-05 20:57:52.png';
            $path = path('storage').'tempimg/' . $image;
            if (file_exists($path)) {
                return Response1::inline($path);
            }
            return Response1::error(404);
});



