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

	//listing users

	public function beneficiaryList()
	{
		
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
		$csv_output .= "Serial No, User Id, First Name, Last Name, Email, Phone, Highest Qualification, Educational Institution, Work Experience, Address, SMS Alerts / Phone Calls, Registered Date, Registered Time,".$created_by."\n";
		$arr = array();
		$j = 0;
		foreach ($users as $row) {
			$j++;
			$id =  $row->id;
			$first_name  =  $row->first_name;
			$last_name = $row->last_name;
			$email = $row->email;
			$phone = $row->phone_2;
			$highest_qualification = $row->vm_highestqualification;
			$educational_institution = $row->vm_educationalinstituition;
			$work_experience = $row->vm_workexperience;
			$address = '"'.$row->address_1.', '.$row->city.', '.$row->state.' - '.$row->zip.'"';
			$sms = $row->vm_smsalerts;
			$registered_date = date('d-M-Y', $row->createDate);
			$registered_time = date('h.i.s A', $row->createDate);
			if(Auth::user()->usertype == 'admin') $user_created_by = $row->usertype;
			$csv_output_row1 = "$j, $id, $first_name, $last_name, $email, $phone, $highest_qualification, $educational_institution, $work_experience, $address, $sms, $registered_date, $registered_time, $user_created_by \n";
								
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

}

