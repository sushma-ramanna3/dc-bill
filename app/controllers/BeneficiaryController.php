<?php

class BeneficiaryController extends BaseController {


	public function __construct()
	{
		$this->beforeFilter('admin');
		//$this->beforeFilter('franchise', array('only'=>array('create', 'store', 'edit', 'update', 'destroy')));
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		
	}

	public function recommendedFrom()
	{
		$recommendedFrom = Mstproductname::getrecommendedFromList(Input::get('recommended_by'));
		return Response::json($recommendedFrom);
	}
	//listing users

	public function usersList()
	{
		$users = DB::table('trnbeneficiary')
					->leftJoin('trnbeneficiaryproddetails', 'trnbeneficiary.BeneID', '=', 'trnbeneficiaryproddetails.intbeneID')
					->leftJoin('mstproductname', 'mstproductname.intProdID', '=', 'trnbeneficiaryproddetails.intProdID')
					->select('trnbeneficiary.BeneID', 'trnbeneficiary.txtbeneficiaryname', 'trnbeneficiary.txtbeneAddress','trnbeneficiary.intbeneRSK','trnbeneficiary.intbeneTaluk',
						'trnbeneficiary.intbeneVillage', 'trnbeneficiary.intbeneDistrict', 'trnbeneficiary.intbenePinCode', 
						'trnbeneficiary.txtbeneContactNo', 'trnbeneficiary.intbeneAmtReceived', 'trnbeneficiary.intbeneCategory','trnbeneficiary.created_at',
						'mstproductname.txtProdName', 'trnbeneficiaryproddetails.decFullRate')
					->groupBy('trnbeneficiary.BeneID');

		if (Input::has('beneficiary_name')) {
          	$users->where('trnbeneficiary.txtbeneficiaryname', 'LIKE', '%'.Input::get('beneficiary_name').'%');
		}
          
        if(Input::has('from_date') && Input::has('to_date')) {
        	$date_range = 'From '.Input::get('from_date').' To '.Input::get('to_date');
			$users->whereBetween('trnbeneficiary.created_at', array(Input::get('from_date'), Input::get('to_date') ) );
        }

        if (Input::get('submit') == 'download')
        {
        	$users = $users->orderBy('trnbeneficiary.created_at', 'asc')->get();
          	$this->generateReport($users, $date_range = '');
        }

		$users = $users->orderBy('trnbeneficiary.BeneID', 'ASC ')->paginate(10);
					//	dd(count($users));
		$pagination = $users->appends(
	        array(
	            'beneficiary_name' => Input::get('beneficiary_name'),
	            'from_date' => Input::get('from_date'),
	            'to_date' => Input::get('to_date')
	        ))->links();

		$users = array('users' => $users, 'pagination' => $pagination);

		return View::make('users.users_list')->with('users', $users);
	}

	//download user list report

	public function generateReport($users, $date_range = NULL)
	{
		$csv_output = $created_by = $user_created_by = '';
		$answers = '';
		$report_heading = ", Users";
		$report_file = "Users_Details";
		$csv_output .= '';
		if($date_range) $date_range = "\n , Date range - ".$date_range;
		$csv_output .= $report_heading.' '.date('d-F-Y h:i A').$date_range;
		$csv_output .= "\n";
		
		if(Auth::user()->usertype == 'admin') $created_by = "Registered by";
		$csv_output .= "Serial No, Beneficiary Id, Beneficiary Name, Phone, Category, Product, Full Rate, Address, Registered Date,".$created_by."\n";
		$arr = array();
		$j = 0;
		foreach ($users as $row) {
			$j++;
			$id =  $row->BeneID;
			$txtbeneficiaryname  =  $row->txtbeneficiaryname;

			if($row->intbeneCategory == 1)
				$intbeneCategory = 'General';
			elseif ($row->intbeneCategory == 2) 
				$intbeneCategory = 'SC';
			elseif ($row->intbeneCategory == 3) 
				$intbeneCategory = 'ST';

			$txtbeneContactNo = $row->txtbeneContactNo;
			//$work_experience = $row->vm_workexperience;
			$village = DB::table('mstvillage')->where('intVillageID', '=', $row->intbeneVillage)->pluck('txtVillageName');
			$hobli = DB::table('msthoblirsk')->where('intHobliRSKID', '=', $row->intbeneRSK)->pluck('txtHobliRSK');
			$taluk = DB::table('msttaluk')->where('intTalukID', '=', $row->intbeneTaluk)->pluck('txtTalukName');
			$district = DB::table('mstdistrict')->where('intDistrictID', '=', $row->intbeneDistrict)->pluck('txtDistrictName');

			$address = '"'.$row->txtbeneAddress.' '.$village.', '.$hobli.', '.$taluk.', '.$district.' - '.$row->intbenePinCode.'"';
			$txtProdName = $row->txtProdName;
			$decFullRate = $row->decFullRate;
			$registered_date = $row->created_at;
			$registered_time = ''; //date('h.i.s A', $row->created_at);
			//$registered_date = $registered_date.' '.$registered_time;
			if(Auth::user()->usertype == 'admin') $user_created_by = $row->registeredBy;
			$csv_output_row1 = "$j, $id, $txtbeneficiaryname, $txtbeneContactNo, $intbeneCategory, $txtProdName, $decFullRate, $address, $registered_date, $user_created_by \n";
								
			$csv_output .=$csv_output_row1;
		}
		$file = $report_file.'_'.date('d-m-Y h:i A').'.csv';
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Type: application/csv;charset=utf-8");// tell the browser it's going to be a csv file
		header('Content-Disposition: attachement; filename="'.$file.'"');
		echo $csv_output;
		exit;
	}


	public function beneficiaryInfo(){
		$user = DB::table('trnbeneficiary')
					->leftJoin('trnbeneficiarycropdetails', 'trnbeneficiary.BeneID', '=', 'trnbeneficiarycropdetails.intbeneID')
					->leftJoin('msttaluk', 'trnbeneficiary.intbeneTaluk', '=', 'msttaluk.intTalukID')
					->leftJoin('mstdistrict', 'trnbeneficiary.intbeneDistrict', '=', 'mstdistrict.intDistrictID')
					->leftJoin('msthoblirsk', 'trnbeneficiary.intbeneRSK', '=', 'msthoblirsk.intHobliRSKID')
					->leftJoin('mstvillage', 'trnbeneficiary.intbeneVillage', '=', 'mstvillage.intVillageID')
					->leftJoin('trnbeneficiaryproddetails', 'trnbeneficiary.BeneID', '=', 'trnbeneficiaryproddetails.intbeneID')
					->leftJoin('mstproductname', 'mstproductname.intProdID', '=', 'trnbeneficiaryproddetails.intProdID')
					//->leftJoin('trnbeneficiarydocuments', 'trnbeneficiary.BeneID', '=', 'trnbeneficiarydocuments.intbeneID')
					->select('trnbeneficiary.intbenePinCode', 'trnbeneficiarycropdetails.survey_no', 'msttaluk.txtTalukName', 'mstdistrict.txtDistrictName', 'mstvillage.txtVillageName', 'msthoblirsk.txtHobliRSK', 'trnbeneficiary.BeneID', 
						'trnbeneficiary.txtbeneficiaryname', 'trnbeneficiary.txtbeneAddress',
						'trnbeneficiary.txtbeneContactNo', 'trnbeneficiary.intbeneAmtReceived', 'trnbeneficiary.intbeneCategory','trnbeneficiary.created_at',
						'mstproductname.txtProdName', 'trnbeneficiaryproddetails.decFullRate')
					->where('trnbeneficiary.BeneID', Input::get('id'))
					//->whereIn('trnbeneficiarydocuments.intDocType', array(1,2,3,4))
					->get();

		return View::make('beneficiary.index')->with('user', $user);
	}

	public function products()
	{
		$rules = array(
	        'product_name' => 'required|min:3|max:80|unique:franchise_products',
	        'product_sku' => 'required',
	        'product_validity_period' => 'required',
	        'product_price'     => 'required',
	        'franchise_id'	=> 'required'
		);
		
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->passes()) {
			if(Input::get('publish') != 1) $publish = 0; 
			else $publish = Input::get('publish');

			$franchises_id = implode(',', Input::get('franchise_id'));
			//dd($franchises_id);
			$product_details = array(
								'product_name' => Input::get('product_name'),
								'product_sku' => Input::get('product_sku'),
								'product_validity_period' => Input::get('product_validity_period'),
								'product_price' => Input::get('product_price'),
								'franchise_ids' => $franchises_id,
								'publish' => $publish,
								'created_at' => new DateTime,
								'updated_at' => new DateTime 
								);
			$save_product = FranchiseProducts::create($product_details);

			return Redirect::to('users')->with('success', 'Product created successfully.');
		}

		return Redirect::to('users')
			->withInput()
			->withErrors($validator);
			
	}

	public function photoDownload($user_id)
	{
		$file = DB::table('trnbeneficiarydocuments')->where('intbeneID', '=', $user_id)
				->where('intDocType', '=', 1)->pluck('txtDocPath');
		return Response::download( public_path().$file);
	}

	public function user_file($file_name = "")
	{
	    if ($file_name)
	    {
	        // Ensure no funny business names to prevent directory transversal etc.
	        $file_name = str_replace ('..', '', $file_name);
	        $file_name = str_replace ('/', '', $file_name);

	         // now do the logic to check user is logged in
	        if (Auth::check())
	        {
	            // Serve file via readfile() - we hard code the user_ID - so they
	            // can only get to their own images
	            readfile('../your_app/samples/'.Auth::user()->id.'/'.$file);
	        }
	    }
	}



}

