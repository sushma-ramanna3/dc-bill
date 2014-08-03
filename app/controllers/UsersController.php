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

		$districts = Mstdistrict::getDistrictList();

		$intProdID = Mstproductname::getProductList();

		$intDocTypeID = array();

		return View::make('users.index')->with('districts', $districts)->with('intProdID', $intProdID)
		->with('intDocTypeID', $intDocTypeID);

	}

	public function taluk()
	{
		$taluks = Msttaluk::getTalukList(Input::get('district_id'));
		return Response::json($taluks);
	}

	public function hobli()
	{
		$hoblirsk = Msthoblirsk::getHoblirskList(Input::get('taluk_id'));
		return Response::json($hoblirsk);
	}

	public function registration()
	{
		
		$rules = array(
		        'first_name' => 'required|min:3|max:80', //|alpha
		        'address' => 'required|min:1|max:80',
		       // 'txtbeneState' => 'required|min:10',
		        'district_id' => 'required',
		        'taluk_id'	=> 'required',
		        'hoblirsk_id'	=> 'required',
		        'phone'	=> 'required|numeric',
		        'zip'	=> 'required|min:6',
		        'dob' => 'required',
		        //'intbeneAge' => 'numeric',
		        'gender' => 'required',
		        'category' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);
		
		if ( $validator->passes() ) {
			$age = '25';

			if( Input::get('first_name') && !Input::get('last_name') )
				$name = Input::get('first_name');
			elseif( Input::get('first_name') && Input::get('last_name') )
				$name = Input::get('first_name').' '.Input::get('last_name');

			$beneficiary_id = DB::table('trnbeneficiary')->insertGetId(array(
									'txtbeneficiaryname' => $name,
									'txtbeneAddress' => Input::get('address'),
									'txtbeneState' => 'Karnataka',
									'intbeneDistrict' => Input::get('district_id'),
									'intbeneTaluk' => Input::get('taluk_id'),
									'intbeneRSK' => Input::get('hoblirsk_id'),
									'txtbeneContactNo' => Input::get('phone'),
									'intbenePinCode' => Input::get('zip'),
									'dtdateofBirth' => Input::get('dob'),
									'intbeneAge' => $age,
									'txtbeneSex' => Input::get('gender'),
									'intbeneCategory' => Input::get('category'),
									'created_at' => new DateTime, //dtDateofApplication
									'updated_at' => new DateTime 
									));

			//$save_beneficiary_details = Trnbeneficiary::create($beneficiary_details);
			$beneficiary_name = DB::table('trnbeneficiary')->where('BeneID', $beneficiary_id)->pluck('txtbeneficiaryname');

			return Redirect::to('users')->with('beneficiary_id', $beneficiary_id)->with('beneficiary_name', $name)->with('success', 'Beneficiary data saved successfully.');
		}

		return Redirect::to('users')
			->withInput()
			->withErrors($validator);
		
	}


}
