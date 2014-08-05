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
			if(Input::get('user_register')){
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

				return Redirect::to('users')->with('beneficiary_id', $beneficiary_id)->with('beneficiary_name', $name)
				->with('success', 'Beneficiary data saved successfully.');
			}
			elseif (Input::get('beneficiary_id') && Input::get('intProdID')) {
				DB::table('trnbeneficiaryproddetails')->insert(array(
					'intbeneID' => Input::get('beneficiary_id'),
					'intProdID' => Input::get('intProdID'),
					'intManufacturerID' => 'Karnataka',
					'intModelID' => Input::get('district_id'),
					'intSpecID' => Input::get('taluk_id'),
					'decFullRate' => Input::get('hoblirsk_id'),
					'decGovtShare' => Input::get('decGovtShare'),
					'decFarmerShare' => Input::get('decFarmerShare'),
					'intQty' => Input::get('intQty'),
					'intUnitofMeasure' => Input::get('intUnitofMeasure'),
					'flgisActive' => 1,
					'created_at' => new DateTime, 
					'updated_at' => new DateTime 
					));
				return Redirect::to('users')->with('beneficiary_id', Input::get('beneficiary_id'))->with('product_id', Input::get('intProdID'))
				->with('beneficiary_name', Input::get('beneficiary_id'))->with('success', 'Product data saved successfully.');
			}
			elseif (Input::get('beneficiary_id') && Input::get('docTypeID')) {
				DB::table('trnbeneficiarydocuments')->insert(array(
					'intbeneID' => Input::get('beneficiary_id'),
					'intDocType' => Input::get('docTypeID'),
					'flgDocUploaded' => 1,
					'txtDocPath' => $doc_path,
					'flgisActive' => 1,
					'created_at' => new DateTime, 
					'updated_at' => new DateTime 
					));
				
				return Redirect::to('users')->with('beneficiary_id', Input::get('beneficiary_id'))->with('doc_type', Input::get('docTypeID'))
				->with('beneficiary_name', Input::get('beneficiary_id'))->with('success', 'Document uploaded successfully.');
			}
			elseif (Input::get('beneficiary_id') && Input::get('intbeneModeofPayment')) {
								
				DB::table('trnbeneficiary')
				            ->where('BeneID', trim(Input::get('beneficiary_id')))
				            ->update(array('intbeneModeofPayment' => Input::get('payment_type'),
				            	'txtbeneDDChequeNo' => Input::get('cheque_dd_no'),
				            	'flgbeneisAmountRemitted' => Input::get('flgbeneisAmountRemitted'),
				            	'intbeneAmtReceived' => Input::get('intbeneAmtReceived')
				            ));
				return Redirect::to('users')->with('success', 'Payment data saved successfully.');
			}

		}

		return Redirect::to('users')
			->withInput()
			->withErrors($validator);
		
	}


}
