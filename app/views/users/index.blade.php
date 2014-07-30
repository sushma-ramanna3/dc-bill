@extends('layouts.main')
@section('content')
 
  	<h3>Admin Dashboard</h3>

  	<ul id="tabs" class="nav nav-tabs bold" data-tabs="tabs">
  		@if(Auth::check() && Auth::user()->usertype == 'admin')
  			<li class="active"><a href="#product" data-toggle="tab">Add Products</a></li>
  			<li><a href="{{ URL::to('franchise') }}">Products list</a></li>
  			<!-- <li class="mail"><a href="#mail" data-toggle="tab">Send Mail</a></li> -->
  		@else
  		 	<li class="active tab"><a href="#users" data-toggle="tab">User Registration & Product Purchase</a></li>
		    <li class="users tab"><a href="#users" data-toggle="tab">Register User</a></li>
		    <li class="tab"><a href="#users" data-toggle="tab">Product Purchase</a></li>
	    @endif
	    	<li><a href="users-list">Users List</a></li>
		    <li><a href="orders">Sales Report</a></li>
  	</ul>

	@if( $errors->has() || HTML::ul($errors->all()) )
       	<div id="form-errors" class="red">
          <p>The following errors have occurred:</p>
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div><!-- end form-errors -->
    @elseif(Session::get('error')) 
		<div id="form-errors" class="red"> 
			{{Session::get('error')}}
		</div>
  	@elseif(Session::get('success'))
	    <div class="alert alert-success alert-block">
	      {{ Session::get('success') }} 
	    </div>
  	@elseif(Session::get('message')) 
	    <div class="alert alert-info alert-block">
	      {{ Session::get('message') }} 
	    </div>
  	@elseif(Session::get('warning')) 
	    <div class="alert alert-warning alert-block">
	      {{ Session::get('warning') }} 
	    </div>
  	@endif

  	<div id="my-tab-content" class="tab-content">
		@if(Auth::check() && Auth::user()->usertype != 'admin')
		    <div id="users" class="tab-pane active">   
		    	<form class="form-horizontal col-md-12" action="/registration" method="post" id="userform">
		            <fieldset id="fieldsetappend" >

		            <div class="form-group">
		              	<div class="col-md-5 marg-top">
		                	{{ 'Fields marked as <span class="red font-bold"> *</span> are mandatory' }}
		              	</div>
		            </div>
					<input id="user_register" name="user_register" class="none" type="hidden" value="" />
					<input id="only_purchase" name="only_purchase" class="none" type="hidden" value="" />
 					<div class="col-md-6">
			            <!-- Text input-->
			            <div class="form-group purchase">
			              <label class="col-md-5 control-label" for="first_name">First Name<span class="red font-bold"> *</span> </label>  
			              <div class="col-md-7">
			              {{ Form::text('first_name', Input::old('first_name'), array('class'=>'form-control input-md','placeholder'=>'enter your first name', 'required' => 'true', 'id' => 'first_name')) }}
			              </div>
			            </div>

			            <!-- Text input-->
			            <div class="form-group purchase">
			              <label class="col-md-5 control-label" for="last_name">Last Name<span class="red font-bold"> *</span></label>  
			              <div class="col-md-7">
			              {{ Form::text('last_name', Input::old('last_name'), array('class'=>'form-control input-md','placeholder'=>'enter your last name', 'required' => 'true', 'id' => 'last_name')) }}  
			              </div>
			            </div>

			            <!-- Text input-->
			            <div class="form-group email_div">
			              <label class="col-md-5 control-label" for="email">Email ID<span class="red font-bold"> *</span></label>  
			              <div class="col-md-7">
			              {{ Form::email('email', Input::old('email'), array('class'=>'form-control input-md','placeholder'=>'enter your email', 'required' => 'true', 'id' => 'email')) }}  
			              </div>
			              <input id="user_exist" name="user_exist" class="none" type="hidden" value=""/>
			            </div>
			
			          <!-- Text input-->
			          	<div class="form-group purchase" id="phone_valid">
				            <label class="col-md-5 control-label" for="phone">Phone Number<small> (10 Digits only)</small><span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              {{ Form::text('phone', Input::old('phone'), array('class'=>'form-control input-md','placeholder'=>'phone number', 'minlength'=>'10', 'maxlength'=>'10', 'required' => 'true', 'id' => 'phone')) }}      
				            </div>
			          	</div>
		          	</div>
					<div class="col-md-6">
			          <!-- Text input-->
			          	<div class="form-group purchase">
				            <label class="col-md-5 control-label" for="twelfth">Highest Qualification<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				            	{{ Form::select('highest_qualification', array('' => '--Course--', 'Not a Graduate' => 'Not a Graduate', 'Graduation - Others' => 'Graduation - Others', 'Graduation - Engineering' => 'Graduation - Engineering', 
				            	'Graduation - Commerce' => 'Graduation - Commerce', 'Post Graduation - Others' => 'Post Graduation - Others',
				            	 'CA' => 'CA', 'MBA (Non - Finance)' => 'MBA (Non - Finance)', 'MBA - Finance' => 'MBA - Finance', 'Others' => 'Others'), '--Course--', array('class'=> 'form-control input-md','required' => 'true', 'id'=>'highest_qualification')) }}
				            </div>
			          	</div>

			          <!-- Text input-->
			          	<div class="form-group purchase">
				            <label class="col-md-5 control-label" for="graduation">Educational Institution<span class="red font-bold"> *</span></label>  
				            <div class="col-md-6">
				            	{{ Form::text('educational_institution', Input::old('educational_institution'), array('class'=>'form-control input-md','placeholder'=>'Educational Institution','required' => 'true',  'id' => 'educational_institution')) }}
				            </div>
		  					<img rel="tooltip" src="/assets/images/con_info.png" title="Please enter the name of the college/institution you are currently attending/last attended, whichever is applicable." />
			          	</div>
			
						<!-- Text input-->
			          	<div class="form-group purchase">
				            <label class="col-md-5 control-label" for="twelfth">Work Experience<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				            	{{ Form::select('work_experience', array('' => '--Select--', '72months' => '72+ Months', '36_71months' => '36 - 71 Months', 
				            	'12_35months' => '12 - 35 Months', '1_11months' => '1 - 11 Months', 'no_work_experience' => 'No Work Experience'), '--Select--', array('class'=> 'form-control input-md','required' => 'true', 'id' =>'work_experience')) }}
				            </div>
			          	</div>

			          	<div class="form-group sms">
				            <label class="col-md-5 control-label" for="resume">SMS Alerts / Phone Calls<span class="red font-bold"> *</span></label>
				            <div class="col-md-7 radio_sms" style="font-size:12px;padding-right:0;">
				             	{{ Form::label('yes','Yes. Call or do send me SMS alerts', array('class'=>'radio-inline')) }}
				             	{{ Form::radio('smsalerts', 'Yes', '', array('required'=>'required', 'class'=>'pull-left', 'id'=>'yes')) }}
				              	
				              	<span style="display: block;float: right;">I do not wish to receive any SMS alerts / Phone Calls</span>
			              		{{ Form::radio('smsalerts', 'No', '', array('required'=>'required', 'class'=>'pull-left', 'id'=>'no')) }}
			              		
				            </div>
			      		</div>
					</div>
					
					<div class="form-group purchase col-md-12" style="width:99%;margin-right:27px;">
			            <label class="col-md-3 col-custom control-label" for="phone">Address<span class="red font-bold"> *</span></label>  
			            <div class="col-md-3">
			              {{ Form::text('address', Input::old('address'), array('class'=>'form-control input-md address','placeholder'=>'Address', 'required' => 'true', 'id'=>'address')) }}      
			            </div>
			             <div class="col-md-2">
			              {{ Form::text('city', Input::old('city'), array('class'=>'form-control input-md city','placeholder'=>'City', 'required' => 'true', 'id'=>'city')) }}      
			            </div>
			            <div class="col-md-2">
			              {{ Form::select('state', $states, Input::old('state'), array('class' => 'form-control input-md state', 'required' => 'true', 'id'=>'state')) }}  
			            </div>
			            <div class="col-md-2">
			              {{ Form::text('zip', Input::old('zip'), array('class'=>'form-control input-md','placeholder'=>'zip', 'maxlength'=>'6', 'minlength'=>'6', 'id' => 'zip', 'required' => 'true')) }}      
			            </div>
		          	</div>

					<div class="form-group all_products">
			            <label class="col-md-3 col-custom control-label" for="graduation">FLIP Programs <!-- <span class="red font-bold"> *</span> --></label>  
			            <div class="col-md-6">
							{{ Form::select('product_id[]', $products , Input::old('product_id'), array('class' => 'form-control input-md', 'id' => 'product_id', 'multiple' => 'multiple', 'required' => 'true')) }}
						</div>
						<img rel="tooltip" src="/assets/images/con_info.png" title="Multiselect: use CTRL-Key and Mouse" />
					</div>	

					<div class="form-group all_products">
			            <label class="col-md-3 col-custom control-label" for="graduation">Programs with classroom</label>  
			            <div class="col-md-6">
							{{ Form::select('classroom_product_id[]', $franchise['classroom_products'], Input::old('classroom_product_id'), array('class' => 'form-control input-md', 'id' => 'classroom_product_id', 'multiple' => 'multiple')) }}
						</div>
						<img rel="tooltip" src="/assets/images/con_info.png" title="Multiselect: use CTRL-Key and Mouse" />
					</div>	

					<div class="form-group all_products">
			            <label class="col-md-3 col-custom control-label" for="graduation">Select your product(s)</label>  
			            <div class="col-md-6">
							{{ Form::select('franchise_product_id[]', $franchise['franchise_products'], Input::old('franchise_product_id'), array('class' => 'form-control input-md', 'id' => 'franchise_product_id', 'multiple' => 'multiple')) }}
						</div>
						<img rel="tooltip" src="/assets/images/con_info.png" title="Multiselect: use CTRL-Key and Mouse" />
					</div>	

					<div class="form-group all_products">
			            <label class="col-md-3 col-custom control-label" for="declaration">Additional product</label>
			            <div class="col-md-6">
			              <label class="checkbox-inline" for="declaration-0">
			              	{{ Form::checkbox('system_access[]', '1', false, array('id' => 'system_access')) }}
			              	I want to include the charges for accessing training in center.
			              </label>
			            </div>
			      	</div>

					<div class="form-group none" id="info">
						<label class="col-md-3 col-custom control-label">Product Details</label>
						<div class="col-md-9 pro_info">
						  	<table width="100%">
						  		<tbody>
						  			<tr class="bold blue">
						  				<td><span>Products</span></td>
						  				<td><span>Validity (Days)</span></td>
										<td><span>Price (INR)</span></td>
						  			</tr>
						  			<tr class="pproducts none"><td colspan="3"><hr></td></tr>
						  			<tr class="pproducts none"><td colspan="3" class="bold">FLIP products</td></tr>
						  			<tr>

						  				<td><span class="product_name1"></span></td>
						  				<td><span class="product_validity1"></span></td>
						  				<td><span class="product_price1"></span></td>
						  			
						  			</tr>
						  			<tr class="cproducts none"><td colspan="3"><hr></td></tr>
						  			<tr class="cproducts none"><td colspan="3" class="bold">Classroom products</td></tr>
						  			<tr class="cproducts none">

						  				<td><span class="cproduct_name1"></span></td>
						  				<td><span class="cproduct_validity1"></span></td>
						  				<td><span class="cproduct_price1"></span></td>
						  			
						  			</tr>
						  			<tr class="fproducts none"><td colspan="3"><hr></td></tr>
						  			<tr class="fproducts none"><td colspan="3" class="bold">Franchise products</td></tr>
						  			<tr class="fproducts">
						  				<td><span class="fproduct_name1"></span></td>
						  				<td><span class="fproduct_validity1"></span></td>
						  				<td><span class="fproduct_price1"></span></td>
						  			</tr>

						  			<tr class="system_access none"><td colspan="3"><hr></td></tr>
						  			<tr class="system_access none"><td colspan="3" class="bold">Additional Product</td></tr>
						  			<tr class="system_access none">
						  				<td><span class="system_access_product_name"></span></td>
						  				<td><span class="system_access_product_validity"></span></td>
						  				<td><span class="system_access_product_price"></span></td>
						  			</tr>

						  			<tr><td colspan="3"><hr></td></tr>
						  			<tr class="pproducts none">
						  				<td></td>
						  				<td class="blue">Order Subtotal [FLIP Programs]</td>
						  				<td><span class="order_subtotal">-</span> 
						  					<input id="order_subtotal1" type="hidden" value=""/>
						  				</td>
						  			</tr>
						  			<tr class="cproducts none">
						  				<td></td>
						  				<td class="blue">Order Subtotal [With Classroom]</td>
						  				<td><span class="corder_subtotal">-</span> 
						  					<input id="corder_subtotal1" type="hidden" value=""/>
						  				</td>
						  			</tr>
						  								  			
						  			<tr class="fproducts none">
						  				<td></td>
						  				<td class="blue">Order Subtotal [Franchisee]</td>
						  				<td><span class="forder_subtotal">-</span> 
						  					<input id="forder_subtotal1" type="hidden" value=""/>
						  				</td>
						  			</tr>

						  			<tr class="fr_coupon none">
						  				<td></td>
						  				<td class="blue">Franchisee Coupon Discount</td>
						  				<td><span class="frcoupon" >-</span> 
							  				<button style="padding:1px 2px;" class="btn btn-warning btn-mini" id="edit_coupon" value=""><i class="glyphicon glyphicon-edit"></i></button>
							  				<button style="padding:1px 2px;" class="btn btn-danger btn-mini" id="delete_coupon" value=""><i class="glyphicon glyphicon-trash"></i></button>
						  					<input id="frcoupon" name="frcoupon" type="hidden" value="" />
						  				</td>
						  			</tr>

						  			<tr class="flip_coupon none">
						  				<td></td>
						  				<td class="blue">FLIP Coupon Discount</td>
						  				<td><span class="flipcoupon" >-</span> 
						  					<input id="coupon_code1" type="hidden" name="coupon_code1" value="" />
						  					<input id="coupon_discount" type="hidden" name="coupon_discount" value="" />
						  				</td>
						  			</tr>

						  			<tr class="system_access none">
						  				<td></td>
						  				<td class="blue">Order Subtotal [Additional Product]</td>
						  				<td><span class="systemaccess_subtotal"></span> 
						  					<input id="systemaccess_subtotal" type="hidden" value=""/>
						  				</td>
						  			</tr>
						  			
						  			<tr><td colspan="3"><hr></td></tr>
						  			
						  			<tr class="bold">
						  				<td></td>
						  				<td class="blue">Order Subtotal</td>
						  				<td><span class="grand_order_subtotal"></span></td>
						  			</tr>
						  			<tr class="bold">
						  				<td></td>
						  				<td class="blue">Total Tax</td>
						  				<td><span class="grand_order_tax"></span></td>
						  			</tr>
						  			<tr class="bold red"><td colspan="3"><hr></td></tr>
						  			<tr class="bold">
						  				<td></td>
						  				<td class="blue">Order Total</td>
						  				<td><span class="grand_order_total"></span></td>
						  			</tr>
						  		</tbody>
						  	</table>
					  	</div>
					</div>

		            <!-- Button -->
		            <div class="form-group">
		              <label class="col-md-3 control-label" for="submit"></label>
		              <div class="col-md-3">
		                <button id="submit_userform" name="submit" class="btn btn-lg btn-success btn-block"> Submit </button>
		              </div>
		            </div>
	      		</fieldset>
	        </form>

    	<!-- Text input-->
			<form class="form-horizontal col-md-12 none info" action="/flip-coupon" method="post" id="coupon">	      
	            <div class="form-group all_products">
	              	<label class="col-md-3 col-custom control-label" for="coupon">FLIP Coupon code</label>  
	              	<div class="col-md-4">
	          			{{ Form::text('flip_coupon_code', Input::old('flip_coupon_code'), array('class'=>'form-control input-md','placeholder'=>'flip coupon code', 'id' => 'coupon_code', 'required' => 'true')) }}  
	          			<input id="user_email" name="user_email" class="none" type="hidden" value="" />
	          			<input id="forder_subtotal" name="forder_subtotal" class="none" type="hidden" value="" />
	          			<select multiple="multiple" id="selected_products" class="none" name="selected_products[]" type="hidden"></select>
          			</div>
	              	<div class="col-md-1">
	              		<button id="coupon_submit" name="submit" class="btn btn-lg btn-success btn-block">Apply</button>
	              	</div>
	            </div>
            </form>

        	<!-- <form class="form-horizontal col-md-12 none info" id="franchise-coupon">	  -->
        	<div class="form-horizontal col-md-12 none info" id="franchise-coupon">	      
	            <div class="form-group all_products">
	              	<label class="col-md-3 col-custom control-label" for="coupon">Franchise Coupon code</label>  
	              	<div class="col-md-4">
	          			{{ Form::text('franchise_coupon_code', Input::old('franchise_coupon_code'), array('class'=>'form-control input-md integer_field','placeholder'=>'franchise coupon code', 'id' => 'franchise_coupon_code', 'maxlength'=>'4')) }}  
	          			<input id="corder_subtotal" name="corder_subtotal" class="none" type="hidden" value="" />
	          			<input id="frorder_subtotal" name="frorder_subtotal" class="none" type="hidden" value="" />
	              	</div>
	              	<div class="col-md-1">
	              		<button id="franchise_coupon_submit" name="submit" class="btn btn-lg btn-success btn-block">Apply</button>
	              	</div>
	            </div>
            </div>

	    </div>
	@else
		<div id="product" class="active tab-pane">   
		<h3>Add Franchise Products</h3>
         	<form class="form-horizontal col-md-12" action="/franchise-products" method="post" id="productform">
	            <fieldset id="fieldsetappend" >

		            <!-- Form Name -->
		            <div class="form-group">
		              	<div class="col-md-5">
		                	{{ 'Fields marked as <span class="red font-bold"> *</span> are mandatory' }}
		              	</div>
		            </div>
		
		            <!-- Text input-->
		            <div class="form-group">
		              <label class="col-md-3 control-label" for="first_name">Product Name<span class="red font-bold"> *</span> </label>  
		              <div class="col-md-5">
		              {{ Form::text('product_name', Input::old('product_name'), array('class'=>'form-control input-md','placeholder'=>'product name', 'required' => 'true', 'id' => 'product_name')) }}
		              </div>
		            </div>

		            <!-- Text input-->
		            <div class="form-group">
		              <label class="col-md-3 control-label" for="last_name">Product SKu<span class="red font-bold"> *</span></label>  
		              <div class="col-md-5">
		              {{ Form::text('product_sku', Input::old('product_sku'), array('class'=>'form-control input-md','placeholder'=>'product sku', 'required' => 'true', 'id' => 'product_sku')) }}  
		              </div>
		            </div>

		             <!-- Text input-->
		            <div class="form-group">
		              <label class="col-md-3 control-label" for="first_name">Product Validity<small> (in days)</small><span class="red font-bold"> *</span> </label>  
		              <div class="col-md-5">
		              {{ Form::text('product_validity_period', Input::old('product_validity_period'), array('class'=>'form-control input-md integer_field', 'placeholder'=>'product validity', 'required' => 'true')) }}
		              </div>
		            </div>

		            <!-- Text input-->
		            <div class="form-group">
		              <label class="col-md-3 control-label" for="last_name">Product Price<span class="red font-bold"> *</span></label>  
		              <div class="col-md-5">
		              {{ Form::text('product_price', Input::old('product_price'), array('class'=>'form-control input-md integer_field', 'placeholder'=>'product price', 'required' => 'true')) }}  
		              </div>
		            </div>
			
					<div class="form-group">
			            <label class="col-md-3 control-label" for="graduation">Franchise<span class="red font-bold"> *</span></label>  
			            <div class="col-md-6">
						{{ Form::select('franchise_id[]', $franchise['franchise_list'], Input::old('franchise_id'), array('class' => 'form-control input-md', 'required' => 'true', 'id' => 'franchise_id', 'multiple' => 'multiple')) }}
						</div>
						<img rel="tooltip" src="/assets/images/con_info.png" title="Multiselect: use CTRL-Key and Mouse" />
					</div>	

					<div class="form-group">
	                   	<label class="col-md-3 control-label" for="publish">Publish</label>
	                  	<div class="col-md-6">{{ Form::checkbox('publish', '1', null) }}</div>
	              	</div>

		            <!-- Button -->
		            <div class="form-group">
		              <label class="col-md-3 control-label" for="submit"></label>
		              <div class="col-md-2">
		                <button id="submit" name="submit" class="btn btn-lg btn-success btn-block"> Save </button>
		              </div>
		            </div>
	      		</fieldset>
	        </form>
	    </div>


	 	<div id="mail" class="tab-pane">   
			<h3>Send Mail</h3>
			<div class="col-md-12">
	          <div class="col-md-5"><h4 class="pull-left">Sending login credentials to users</h4></div>
	          <a class="btn btn-primary" href="login-details-mail" disabled="true">Send</a>
	        </div>
	    </div>
	@endif
	<form action="/orders" method="post" id="order">
	    <input id="order_id" name="order_id" type="hidden" value="" />
	    <input id="order_submit" name="order_submit" type="submit" class="none" />
	</form>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Required</h4>
	      </div>
	      <div class="modal-body">
	        <p id="modal-text">
	         	Please select either FLIP or Classroom programs
	        </p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Error Modal -->
	<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title red" id="myModalLabel">Error - Franchise Coupon Code</h4>
	      </div>
	      <div class="modal-body">
	        <p id="modal-text">
	         	Coupion value sholud be greater than 0 and less than 3000!
	        </p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModalCoupon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title red" id="myModalLabel">Error - FLIP Coupon Code</h4>
	      </div>
	      <div class="modal-body">
	        <p id="modal-text1">The offer code you have entered is not valid. Please check if you have entered the right code.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>


</div>

@stop