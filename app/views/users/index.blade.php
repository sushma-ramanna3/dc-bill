@extends('layouts.main')
@section('content')
 
  	<h3>Dashboard</h3>
  	<?php
  		$active1 = $active2 = $active3 = $active4 = $active5 = $id = '';
  		if(Session::get('beneficiary_id')){
  			$id = 1;
  		}
	  	if(Session::get('beneficiary_id') && Session::get('flag3')){
	  		$active1 = $active3 = $active4 = $active5 = '';
	  		$active2 = 'active'; 
	  	}
	  	elseif(Session::get('beneficiary_id') && Session::get('flag')){
	  		$active1 = $active3 = $active4 = $active2 = '';
	  		$active5 = 'active'; 
	  	}
	  	elseif(Session::get('beneficiary_id') && Session::get('flag1') ){
	  		$active1 = $active2 = $active4 = $active5 = '';
	  		$active3 = 'active';
	  	}
	  	elseif(Session::get('beneficiary_id') && Session::get('flag2') ){
	  		$active1 = $active3 = $active2 = $active5 = '';
	  		$active4 = 'active';
	  	}
	  	else{
	  		$active1 = 'active';
	  		$active2 = $active3 = $active4 = $active5 = '';
	  	}
	  	
  	?>
  	<ul id="tabs" class="nav nav-tabs bold" data-tabs="tabs">
  		@if(Auth::check() && Auth::user()->usertype == 'admin')
  			<li class="active"><a href="#product" data-toggle="tab">Add Products</a></li>
  			<li><a href="{{ URL::to('franchise') }}">Products list</a></li>.
  		@else
  		 	<li class="<?php echo $active1;?> tab"><a href="#users" data-toggle="tab">User Registration</a></li>
  		 	<li class="<?php echo $active5;?> tab"><a href="#corps" data-toggle="tab">Corps</a></li>
		    <li class="<?php echo $active2;?> tab"><a href="#product" data-toggle="tab">Product Purchase</a></li>
		    <li class="<?php echo $active3;?> tab"><a href="#documents" data-toggle="tab">Upload Documents</a></li>
		    <li class="<?php echo $active4;?> tab"><a href="#payment" data-toggle="tab">Payment Details</a></li>
	    @endif
	    	<li><a href="users-list">Users List</a></li>
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
		    <div id="users" class="tab-pane <?php echo $active1; ?>">   
		    	<form class="form-horizontal col-md-12" action="/registration" method="post" id="userform">
	            <fieldset id="fieldsetappend" >
		            <div class="form-group">
		              	<div class="col-md-5 marg-top">
		                	{{ 'Fields marked as <span class="red font-bold"> *</span> are mandatory' }}
		              	</div>
		            </div>
					<input name="user_register" class="none" type="hidden" value="1" />

 					<div class="col-md-6">

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="first_name">First Name<span class="red font-bold"> *</span> </label>  
			              <div class="col-md-7">
			              {{ Form::text('first_name', Input::old('first_name'), array('class'=>'form-control input-md','placeholder'=>'enter first name', 'required' => 'true', 'id' => 'first_name')) }}
			              </div>
			            </div>

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="last_name">Last Name</label>  
			              <div class="col-md-7">
			              {{ Form::text('last_name', Input::old('last_name'), array('class'=>'form-control input-md','placeholder'=>'enter last name', 'id' => 'last_name')) }}  
			              </div>
			            </div>

			             <div class="form-group">
			              <label class="col-md-5 control-label" for="last_name">Father Name</label>  
			              <div class="col-md-7">
			              {{ Form::text('father_name', Input::old('father_name'), array('class'=>'form-control input-md city','placeholder'=>'enter last name')) }}  
			              </div>
			            </div>

			           <!--  <div class="form-group email_div">
			              <label class="col-md-5 control-label" for="email">Email ID<span class="red font-bold"> *</span></label>  
			              <div class="col-md-7">
			              {{ Form::email('email', Input::old('email'), array('class'=>'form-control input-md','placeholder'=>'enter your email', 'required' => 'true', 'id' => 'email')) }}  
			              </div>
			              <input id="user_exist" name="user_exist" class="none" type="hidden" value=""/>
			            </div> -->
			
			          	<div class="form-group" id="phone_valid">
				            <label class="col-md-5 control-label" for="phone">Phone Number<small> (10 Digits only)</small><span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              {{ Form::text('phone', Input::old('phone'), array('class'=>'form-control input-md','placeholder'=>'phone number', 'minlength'=>'10', 'maxlength'=>'10', 'required' => 'true', 'id' => 'phone')) }}      
				            </div>
			          	</div>
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="phone">Address<span class="red font-bold"> *</span></label>  
			               	<div class="col-md-7">
			               		{{ Form::textarea('address', Input::old('address'), array('class'=>'form-control input-md address','placeholder'=>'Address', 'required' => 'true', 'id'=>'address')) }}      
			               	</div>
			          	</div>
		          	</div>

					<div class="col-md-6">
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Gender<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				            	 {{ Form::radio('gender','male','', array('id'=>'first1')) }}
				                  {{ Form::label('male','Male', array('style' => 'font-weight:normal', 'required' => 'true'))}} 
				                  {{ Form::radio('gender','female','', array('id'=>'first2')) }}
				                 {{ Form::label('female','Female', array('style' => 'font-weight:normal;', 'required' => 'true')) }} 
				            </div>
			          	</div>
			          
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Date of Birth</label>  
					        <div class="col-md-7 input-append date pull-right" id="dp1" data-date="" data-date-format="dd-mm-yyyy">
					            <input name="dob" id="dob" class="span2" size="16" type="text" value="" readonly />
					            <label class="add-on"><i class="icon-calendar"></i></label>
					        </div>
			          	</div>

			          	<!-- Select Basic -->
				        <div class="form-group">
				            <label class="col-md-4 control-label" for="dob">Date of Birth( dd-mm-yyyy )<span class="red font-bold"> *</span></label>
				            <div class="col-md-2 pull-left">
				              {{ Form::selectRange('dob_day', 1, 31, null, array('class'=>'form-control')); }}
				            </div>
				            <div class="col-md-2 pull-left">
				              {{ Form::selectRange('dob_month', 1, 12, null, array('class'=>'form-control')); }}
				            </div>
				            <div class="col-md-2 pull-left">
				              {{ Form::selectRange('dob_year', 1910, 2010, null, array('class'=>'form-control')); }}
				            </div>
				        </div>

			          	<div class="form-group sms">
				            <label class="col-md-5 control-label" for="age">Age</label>
				            <div class="col-md-7 radio_sms" style="font-size:12px;padding-right:0;">
			              		<input name="age" value="" readonly id="age"/>
			              		<img rel="tooltip" src="/assets/images/con_info.png" title="" />
				            </div> 
			      		</div>
		      			<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Category<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				          		{{ Form::select('category', array(''=>'--Select category--', '1'=>'General', '2'=>'SC', '3'=>'ST'), Input::old('intbeneCategory'), array('class' => 'form-control input-md', 'required' => 'true')) }}    
				            </div>
			          	</div>
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Application For<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				          		{{ Form::select('application_for', $applicationFor, Input::old('application_for'), array('class' => 'form-control input-md', 'required' => 'true')) }}    
				            </div>
			          	</div>
					</div>
					
		          	<div class="form-group col-md-12" style="width:99%;margin-right:27px;">
		          		<label class="col-md-3 col-custom control-label" for="phone">District<span class="red font-bold"> *</span></label>  
			            <div class="col-md-3 col-custom1">
			              {{ Form::select('district_id', $districts, Input::old('district_id'), array('class' => 'form-control input-md', 'required' => 'true', 'id'=>'district_id')) }}  
			            </div>
			             <div class="col-md-3 col-custom1">
			              {{ Form::select('taluk_id', array('0'=>'--Select taluk--'), Input::old('taluk_id'), array('class' => 'form-control input-md state', 'required' => 'true', 'id'=>'taluk_id')) }}     
			            </div>
			            <div class="col-md-3 col-custom1">
			              {{ Form::select('hoblirsk_id', array('0'=>'--Select hobli RSK--'), Input::old('hoblirsk_id'), array('class' => 'form-control input-md state', 'required' => 'true', 'id'=>'hobli')) }}  
			            </div>
			            <div class="col-md-3 col-custom1">
			              {{ Form::select('village_id', array('0'=>'--Select village--'), Input::old('village_id'), array('class' => 'form-control input-md state', 'required' => 'true', 'id'=>'village_id')) }}  
			            </div>
			            <div class="col-md-2">
			              {{ Form::text('zip', Input::old('zip'), array('class'=>'form-control input-md','placeholder'=>'zip', 'maxlength'=>'6', 'minlength'=>'6', 'id' => 'zip', 'required' => 'true')) }}      
			            </div>
		          	</div>

		            <div class="form-group">
		              <label class="col-md-3 control-label" for="submit"></label>
		              <div class="col-md-2">
		                <button id="submit_userform" name="submit" class="btn btn-lg btn-success btn-block">Save & Continue</button>
		              </div>
		            </div>
	      		</fieldset>
	        </form>
	    </div>

	    <div id="product" class="tab-pane <?php echo $active2; ?>">   
         	<form class="form-horizontal col-md-12" action="/registration" method="post" id="productform">
	            <fieldset id="fieldsetappend" >
	            <input name="add_product" class="none" type="hidden" value="1" />
		            <div class="form-group">
		              	<div class="col-md-5">
		                	{{ 'Fields marked as <span class="red font-bold"> *</span> are mandatory' }}
		              	</div>
		              	<div class="col-md-12">
			              	<?php if($id){ ?>
								<input name="beneficiary_id" class="none" type="hidden" value="<?php echo Session::get('beneficiary_id'); ?>" />
		  						<b>Beneficiary ID:</b> <?php echo Session::get('beneficiary_id'); ?> <b>Beneficiary Name:</b> <?php echo Session::get('beneficiary_name'); ?><br>
			              	<?php } ?>
			              	@if($active2)
			              		<!-- <input name="beneficiary_name" class="none" type="hidden" value="<?php //echo Session::get('beneficiary_name'); ?>" /> -->
			              		<input name="category" id="category" class="none" type="hidden" value="<?php echo Session::get('category_id'); ?>" />
		              		@endif
		              	</div>
		            </div>
		
		            <div class="col-md-6">
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Product<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
		              			{{ Form::select('product_id', $intProdID, Input::old('product_id'), array('class'=>'form-control input-md', 'required' => 'true', 'id' => 'product_id')) }}
		              		</div>
	              		</div>
              		  	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Manufacturer<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              	{{ Form::select('manufacturer_id', array('0'=>'--Select manufacturer--'), Input::old('manufacturer_id'), array('class'=>'form-control input-md', 'required' => 'true', 'id'=>'manufacturer_id')) }}  
              				</div>
		            	</div>

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="first_name">Model<span class="red font-bold"> *</span> </label>  
			              <div class="col-md-7">
			              {{ Form::select('model_id', array('0'=>'--Select model--'), Input::old('model_id'), array('class'=>'form-control input-md', 'required' => 'true', 'id' => 'model_id')) }}
			              </div>
			            </div>

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="last_name">Specification<span class="red font-bold"> *</span></label>  
			              <div class="col-md-7">
			              {{ Form::select('spec_id', array('0'=>'--Select specification--'), Input::old('spec_id'), array('class'=>'form-control input-md', 'required' => 'true', 'id'=>'spec_id')) }}  
			              </div>
			            </div>
				
						<div class="form-group">
				            <label class="col-md-5 control-label" for="graduation">Full Rate<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				            	{{ Form::text('fullRate', Input::old('fullRate'), array('class'=>'form-control input-md', 'placeholder'=>'', 'required' => 'true', 'id'=>'fullRate', 'readonly'=>'true')) }}  
							</div>
						</div>	
		            </div>

    	            <div class="col-md-6">
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Government Share<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
		              			{{ Form::text('govtShare', Input::old('govtShare'), array('class'=>'form-control input-md', 'required' => 'true', 'id'=>'govtShare', 'readonly'=>'true')) }}
		              		</div>
	              		</div>
              		  	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Farmer's Share<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              	{{ Form::text('farmerShare', Input::old('farmerShare'), array('class'=>'form-control input-md','placeholder'=>'', 'required' => 'true', 'id'=>'farmerShare', 'readonly'=>'true')) }}  
              				</div>
		            	</div>

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="first_name">Quantity<span class="red font-bold"> *</span> </label>  
			              <div class="col-md-7">
			              {{ Form::text('quantitiy', Input::old('quantitiy'), array('class'=>'form-control input-md integer_field', 'placeholder'=>'', 'required' => 'true')) }}
			              </div>
			            </div>

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="last_name">Unit<span class="red font-bold"> *</span></label>  
			              <div class="col-md-7">
			              {{ Form::select('UOM', $uom, Input::old('UOM'), array('class'=>'form-control input-md', 'required' => 'true', 'id'=>'UOM')) }}  
			              </div>
			            </div>
				
		            </div>
		          
					<!-- Button -->
		            <div class="form-group">
		              <label class="col-md-3 control-label" for="submit"></label>
		              <div class="col-md-2">
		                <button id="submit" name="submit" class="btn btn-lg btn-success btn-block">Save & Continue</button>
		              </div>
		            </div>
	      		</fieldset>
	        </form>
	    </div>

	    <div id="documents" class="tab-pane <?php echo $active3; ?>">   
			
         	<form class="form-horizontal col-md-12" action="/registration" method="post" enctype="multipart/form-data" id="productform">
         		<input name="add_documents" class="none" type="hidden" value="1" />
	            <fieldset id="fieldsetappend" >
		            <div class="form-group">
		              	<div class="col-md-5">
		                	{{ 'Fields marked as <span class="red font-bold"> *</span> are mandatory' }}
		              	</div>
		            </div>
		            <div class="col-md-12">
		              	<?php if($id){ ?>
								<input name="beneficiary_id" class="none" type="hidden" value="<?php echo Session::get('beneficiary_id'); ?>" />
		  						<b>Beneficiary ID:</b> <?php echo Session::get('beneficiary_id'); ?> <b>Beneficiary Name:</b> <?php echo Session::get('beneficiary_name'); ?><br>
			            <?php } ?>
				 	</div>
		            <div class="col-md-6">
	              		<div class="form-group">
				            <label class="col-md-4 control-label" for="photo" required="true">Upload Photo<span class="red font-bold"> *</span></label>
				            <div class="col-md-6">
				              {{ Form::file('photo', array('class'=>'form-control input-md', 'required' => 'true')) }}
				            </div>
			          	</div>
			          	<div class="form-group">
				            <label class="col-md-4 control-label" for="id_proof" required="true">Upload ID Proof</label>
				            <div class="col-md-6">
				              {{ Form::file('id_proof', array('class'=>'form-control input-md')) }}
				            </div>
			          	</div>
              		  	
		           	  	<div class="form-group">
		              		<label class="col-md-3 control-label" for="submit"></label>
			              	<div class="col-md-5">
		                		<button id="submit" name="submit" class="btn btn-lg btn-success btn-block">Upload & Continue</button>
		              		</div>
			            </div>
		            </div>
	      		</fieldset>
	        </form>
	    </div>

	    <div id="payment" class="tab-pane <?php echo $active4; ?>">   
         	<form class="form-horizontal col-md-12" action="/registration" method="post" id="productform">
	            <fieldset id="fieldsetappend" >
		            <div class="form-group">
		              	<div class="col-md-5">
		                	{{ 'Fields marked as <span class="red font-bold"> *</span> are mandatory' }}
		              	</div>
		            </div>
		            <input name="payment_detail" class="none" type="hidden" value="1" />
		            <div class="col-md-12">
			          	<?php if($id){ ?>
								<input name="beneficiary_id" class="none" type="hidden" value="<?php echo Session::get('beneficiary_id'); ?>" />
		  						<b>Beneficiary ID:</b> <?php echo Session::get('beneficiary_id'); ?> <b>Beneficiary Name:</b> <?php echo Session::get('beneficiary_name'); ?><br>
			            <?php } ?>
	              	</div>
					
		            <div class="col-md-6">
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Payment Type<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
		              			{{ Form::select('payment_type', array(''=>'--Select payment type--', '1'=>'Cheque', '2'=>'DD', '3'=>'Other'), Input::old('payment_type'), array('class'=>'form-control input-md', 'required' => 'true')) }}
		              		</div>
	              		</div>
              		  	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Cheque/DD No<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              	{{ Form::text('cheque_dd_no', Input::old('cheque_dd_no'), array('class'=>'form-control input-md','placeholder'=>'', 'required' => 'true')) }}  
              				</div>
		            	</div>

		            	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Account No<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              	{{ Form::text('account_number', Input::old('account_number'), array('class'=>'form-control input-md','placeholder'=>'', 'required' => 'true')) }}  
              				</div>
		            	</div>

	            		<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Bank<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				          		{{ Form::select('bank', $bank, Input::old('bank'), array('class' => 'form-control input-md', 'required' => 'true')) }}    
				            </div>
			          	</div>

		            	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Amount Recieved<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              	{{ Form::text('amount_recieved', Input::old('amount_recieved'), array('class'=>'form-control input-md','placeholder'=>'', 'required' => 'true')) }}  
              				</div>
		            	</div>

			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Payment Date<span class="red font-bold"> *</span></label>  
					        <div class=" col-md-7 input-append date pull-right" id="dp2" data-date="" data-date-format="dd-mm-yyyy">
					            <input name="paymentDate" class="span2" size="16" type="text" value="" readonly />
					            <label class="add-on"><i class="icon-calendar"></i></label>
					        </div>
			          	</div>

			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Amount Remitted<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				            	 {{ Form::radio('amount_remitted','1','', array('id'=>'first1')) }}
				                  {{ Form::label('1','Received', array('style' => 'font-weight:normal'))}} 
				                  {{ Form::radio('amount_remitted','0','', array('id'=>'first2')) }}
				                 {{ Form::label('0','Not yet', array('style' => 'font-weight:normal;')) }} 
				            </div>
			          	</div>

		           	  	<div class="form-group">
		              		<label class="col-md-3 control-label" for="submit"></label>
			              	<div class="col-md-3">
		                		<button id="submit" name="submit" class="btn btn-lg btn-success btn-block">Save</button>
		              		</div>
			            </div>
		            </div>
	      		</fieldset>
	        </form>
	    </div>

	@else
		<div id="product" class="active tab-pane">   
			<h3>Add Products</h3>
         	<form class="form-horizontal col-md-12" action="/products" method="post" id="productform">
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
		            
					<div class="form-group">
	                   	<label class="col-md-3 control-label" for="publish">Publish</label>
	                  	<div class="col-md-6">{{ Form::checkbox('publish', '1', null) }}</div>
	              	</div>

		            <!-- Button -->
		            <div class="form-group">
		              <label class="col-md-3 control-label" for="submit"></label>
		              <div class="col-md-2">
		                <button id="submit" name="submit" class="btn btn-lg btn-success btn-block">Save</button>
		              </div>
		            </div>
	      		</fieldset>
	        </form>
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

</div>

@stop