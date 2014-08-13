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
					->leftJoin('trnbeneficiarydocuments', 'trnbeneficiary.BeneID', '=', 'trnbeneficiarydocuments.intbeneID')
					->select('trnbeneficiary.BeneID', 'trnbeneficiary.txtbeneficiaryname', 'trnbeneficiary.txtbeneAddress',
						'trnbeneficiary.txtbeneContactNo', 'trnbeneficiary.intbeneAmtReceived', 'trnbeneficiary.intbeneCategory','trnbeneficiary.created_at',
						'mstproductname.txtProdName', 'trnbeneficiaryproddetails.decFullRate', 'trnbeneficiarydocuments.txtDocPath')
					->groupBy('trnbeneficiary.BeneID');

		if (Input::has('beneficiary_name')) {
          	$users->where('trnbeneficiary.txtbeneficiaryname', 'LIKE', '%'.Input::get('beneficiary_name').'%');
		}
          
       /*if(Input::has('from_date') && Input::has('to_date')) {
        	$date_range = 'From '.Input::get('from_date').' To '.Input::get('to_date');
			$users->whereBetween('jos_users.createDate', array(strtotime(Input::get('from_date')), strtotime(Input::get('to_date')) ));
        }*/

        if (Input::get('submit') == 'download')
        {
        	$users = $users->orderBy('trnbeneficiary.created_at', 'asc')->get();
          	$this->generateReport($users, $date_range = '');
        }

		$users = $users->orderBy('trnbeneficiary.BeneID', 'ASC ')->paginate(10);
					//	dd(count($users));
		$pagination = $users->appends(
	        array(
	            'beneficiary_name' => Input::get('beneficiary_name')
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
			$txtbeneContactNo = $row->txtbeneContactNo;
			$intbeneCategory = $row->intbeneCategory;
			//$work_experience = $row->vm_workexperience;
			//$address = '"'.$row->txtbeneAddress.', '.$row->txtHobliRSK.', '.$row->txtTalukName.', '.$row->txtDistrictName.' - '.$row->intbenePinCode.'"';
			$address = '';
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

	//Creation of  franchise products by admin

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
		return Response::download($file);
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

