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

		$uom = array('' => '--Select Unit--') + DB::table('mstunitofmeasure')
							->where('flgisActive', 1)
							->orderBy('txtUOM', 'ASC')->lists('txtUOM', 'intUomID');

		$intDocTypeID = array();

		return View::make('users.index')->with('districts', $districts)->with('intProdID', $intProdID)
		->with('intDocTypeID', $intDocTypeID)->with('uom', $uom);

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


	public function manufacturer()
	{
		$manufacturer =  DB::table('mstmanufacturer') //array('' => '--Select manufacturer--') +
							->where('flgisActive', 1)->where('intProdID', Input::get('product_id'))
							->orderBy('txtManufacturerName', 'ASC')->lists('txtManufacturerName', 'intManuID');
		return Response::json($manufacturer);
	}

	public function model()
	{
		$model = DB::table('mstmodel')
							->where('flgisActive', 1)->where('intManuID', Input::get('manufacturer_id'))
							->orderBy('txtModelName', 'ASC')->lists('txtModelName', 'intModelID');
		return Response::json($model);
	}

	public function specificaton()
	{
		$specificaton = DB::table('mstspecification')
							->where('flgisActive', 1)->where('intModelID', Input::get('model_id'))
							->orderBy('txtSpecification', 'ASC')->lists('txtSpecification', 'intSpecID');
		return Response::json($specificaton);
	}

	public function rateShare()
	{
		$rateShare = DB::table('mstrateconfiguration');

		if( Input::get('category_id') == 1 ) {
			$rateShare = $rateShare->select('decFullRate', 'decGeneralFarmerShare', 'decGeneralGovtShare');
		}
		else {
			$rateShare = $rateShare->select('decFullRate', 'decScpFarmerShare', 'decScpGovtShare');
		}

		$rateShare = $rateShare->where('intProdID', Input::get('product_id'))
					->where('intManuID', Input::get('manufacturer_id'))
					->where('intModelID', Input::get('model_id'))
					->where('intSpecification', Input::get('spec_id'))
					->where('flgisActive', 1)
					->get();

		foreach ($rateShare as $val) {
			$decFullRate = $val->decFullRate;
			if( Input::get('category_id') == 1 ) {
				$decFarmerShare = $val->decGeneralFarmerShare;
				$decGovtShare = $val->decGeneralGovtShare;
			}
			else{
				$decFarmerShare = $val->decScpFarmerShare;
				$decGovtShare = $val->decScpGovtShare;
			}
		}
		return Response::json(array('decFullRate' => $decFullRate, 'decFarmerShare' => $decFarmerShare, 'decGovtShare' => $decGovtShare));
	}

	public function registration()
	{
		if(Input::get('user_register')){
			$rules = array(
			        'first_name' => 'required|min:3|max:80', //|alpha
			        'address' => 'required|min:1|max:80',
			        'district_id' => 'required',
			        'taluk_id'	=> 'required',
			        'hoblirsk_id'	=> 'required',
			        'phone'	=> 'required|numeric',
			        'zip'	=> 'required|min:6',
			        'dob' => 'required',
			        'gender' => 'required',
			        'category' => 'required'
			);
		}
		elseif(Input::get('add_product')){
			$rules = array(
			 	'product_id' => 'required',
		        'manufacturer_id'	=> 'required',
		        'model_id'	=> 'required',
		        'spec_id'	=> 'required',
		        'fullRate'	=> 'required',
		        'govtShare' => 'required',
		        'farmerShare'	=> 'required',
		        'quantitiy' => 'required'
	        );
		}
		elseif(Input::get('add_documents')){
			$rules = array(
			 	'photo' => 'required'
		      
	        );
		}
		elseif(Input::get('payment_detail')){
			$rules = array(
			 	'payment_type' => 'required',
		        'cheque_dd_no'	=> 'required'
	        );
		}

		$validator = Validator::make(Input::all(), $rules);
		
		if ( $validator->passes() ) {

			if(Input::get('user_register')){
				$age = $this->age(Input::get('dob'), $flag=1);

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

				$beneficiary_name = DB::table('trnbeneficiary')->where('BeneID', $beneficiary_id)->pluck('txtbeneficiaryname');

				return Redirect::to('users')->with('beneficiary_id', $beneficiary_id)->with('beneficiary_name', $beneficiary_name)
				->with('category', Input::get('category'))
				->with('success', 'Beneficiary data saved successfully.');
			}
			elseif (Input::get('beneficiary_id') && Input::get('product_id')) {
				DB::table('trnbeneficiaryproddetails')->insert(array(
					'intbeneID' => Input::get('beneficiary_id'),
					'intProdID' => Input::get('product_id'),
					'intManufacturerID' =>Input::get('manufacturer_id'),
					'intModelID' => Input::get('model_id'),
					'intSpecID' => Input::get('spec_id'),
					'decFullRate' => Input::get('fullRate'),
					'decGovtShare' => Input::get('govtShare'),
					'decFarmerShare' => Input::get('farmerShare'),
					'intQty' => Input::get('quantitiy'),
					'intUnitofMeasure' => Input::get('UOM'),
					'flgisActive' => 1,
					'created_at' => new DateTime, 
					'updated_at' => new DateTime 
					));
				return Redirect::to('users')->with('beneficiary_id', Input::get('beneficiary_id'))->with('flag1', 1)
				->with('beneficiary_name', Input::get('beneficiary_name'))->with('success', 'Product data saved successfully.');
			}
			elseif (Input::get('beneficiary_id') && Input::hasFile('photo')) {

				if(Input::hasFile('photo')) $docType = 1;
				elseif(Input::hasFile('id_proof')) $docType = 2;

				Input::file('photo')->move( app_path().'/views/photos/', Input::get('beneficiary_id').'_'.time().'_'.Input::file('photo')->getClientOriginalName());
				$photo_path = app_path().'/views/photos/'.Input::get('beneficiary_id').'_'.time().'_'.Input::file('photo')->getClientOriginalName();

				$photo_path = isset($photo_path) ? $photo_path : '' ;

				DB::table('trnbeneficiarydocuments')->insert(array(
					'intbeneID' => Input::get('beneficiary_id'),
					'intDocType' => $docType,
					'flgDocUploaded' => 1,
					'txtDocPath' => $photo_path,
					'flgisActive' => 1
					/*'created_at' => new DateTime, 
					'updated_at' => new DateTime */
					));
				
				return Redirect::to('users')->with('beneficiary_id', Input::get('beneficiary_id'))->with('flag2', 1)
				->with('beneficiary_name', Input::get('beneficiary_name'))->with('success', 'Document uploaded successfully.');
			}
			elseif (Input::get('beneficiary_id') && Input::get('payment_type')) {
								
				DB::table('trnbeneficiary')
				            ->where('BeneID', trim(Input::get('beneficiary_id')))
				            ->update(array('intbeneModeofPayment' => Input::get('payment_type'),
				            	'txtbeneDDChequeNo' => Input::get('cheque_dd_no'),
				            	'flgbeneisAmountRemitted' => Input::get('amount_remitted'),
				            	'intbeneAmtReceived' => Input::get('amount_recieved')
				            ));
				return Redirect::to('users')->with('success', 'Payment data saved successfully.');
			}
		
		}

		return Redirect::to('users')
			->withInput()
			->withErrors($validator);
		
	}

	public function age($dob = null, $flag = null){
		if( empty($flag) )
			$dob = Input::get('dob');

		$dob = explode('-', $dob);

		$birthdate = $dob[1].'-'.$dob[0].'-'.$dob[2];
		$birthDate = explode("-", $birthdate);
		//get age from date or birthdate
		 $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
		    ? ((date("Y") - $birthDate[2]) - 1)
		    : (date("Y") - $birthDate[2]));

		if($flag){
			return $age;
		}
		else{
			return Response::json($age);
		}
	}

	public function cvDownload($user_id)
	{
		/*if(substr($application_id, 0, 4) == 'HDFC'){
			$application_id = explode('_', $application_id);
			$application_id = $application_id[1];
			$file = DB::table('hdfc_applications')->where('id', '=', $application_id)->pluck('cv_path');
		}else{
			$file = DB::table('applications')->where('id', '=', $application_id)->pluck('cv_path');
		}*/
		return Response::download($file);
	}

}
