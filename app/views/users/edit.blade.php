@extends('layouts.main')
@section('content')
 
  	<h3>Dashboard</h3>
  		<?php
  		$active1 = $active2 = $active3 = $active4 = $active5 = '';
  		/*if(Session::get('beneficiary_id')){
  			$id1 = Session::get('beneficiary_id');
  		}*/
  		if(empty(Session::get('beneficiary_name')) ){
  			$name = $first_name.' '.$last_name;
  		}
  		else{
  			$name = Session::get('beneficiary_name');
  		}

  		if(!empty(Session::get('seniorMemberID')) ){
  			$seniorMemberID = Session::get('seniorMemberID');
  		}
  		else{
  			$seniorMemberID = $details['seniorMemberID'];
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
  			<li><a href="{{ URL::to('franchise') }}">Products list</a></li>
  		@else
  		 	<li class="<?php echo $active1;?> tab"><a href="#users" data-toggle="tab">User Registration</a></li>
  		 	<li class="<?php echo $active5;?> tab"><a href="#crops" data-toggle="tab">Crops</a></li>
		    <li class="<?php echo $active2;?> tab"><a href="#product" data-toggle="tab">Product Purchase</a></li>
		    <li class="<?php echo $active3;?> tab"><a href="#documents" data-toggle="tab">Upload Documents</a></li>
		    <li class="<?php echo $active4;?> tab"><a href="#payment" data-toggle="tab">Payment Details</a></li>
	    @endif
	    	<li><a href="/users-list">Users List</a></li>
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
		    	 {{ Form::model($user, array('route' => array('users.update', $id), 'method' => 'PUT', 'class' => 'form-horizontal col-md-12' )) }}
	            <fieldset id="fieldsetappend" >
		            <div class="form-group">
		              	<div class="col-md-5 marg-top">
		                	{{ 'Fields marked as <span class="red font-bold"> *</span> are mandatory' }}
		              	</div>
		            </div>
					<input name="user_register" class="none" type="hidden" value="1" />
					<div class="form-group">
			              <label class="col-md-5 control-label" for="first_name">Senior Member ID<span class="red font-bold"> *</span> </label>  
			              <div class="col-md-4">
			              {{ Form::text('seniorMemberID', Input::old('seniorMemberID'), array('class'=>'form-control input-md', 'required' => 'true')) }}
			              </div>
			        </div>
 					<div class="col-md-6">

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="first_name">First Name<span class="red font-bold"> *</span> </label>  
			              <div class="col-md-7">
			              {{ Form::text('first_name', $first_name, array('class'=>'form-control input-md', 'required' => 'true', 'id' => 'first_name')) }}
			              </div>
			            </div>

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="last_name">Last Name</label>  
			              <div class="col-md-7">
			              {{ Form::text('last_name', $last_name, array('class'=>'form-control input-md', 'id' => 'last_name')) }}  
			              </div>
			            </div>

			             <div class="form-group">
			              <label class="col-md-5 control-label" for="last_name">Father Name</label>  
			              <div class="col-md-7">
			              {{ Form::text('txtbeneFatherName', Input::old('txtbeneFatherName'), array('class'=>'form-control input-md city')) }}  
			              </div>
			            </div>
			
			          	<div class="form-group" id="phone_valid">
				            <label class="col-md-5 control-label" for="phone">Phone Number<small> (10 Digits only)</small><span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              {{ Form::text('txtbeneContactNo', Input::old('txtbeneContactNo'), array('class'=>'form-control input-md','placeholder'=>'phone number', 'minlength'=>'10', 'maxlength'=>'10', 'required' => 'true', 'id' => 'phone')) }}      
				            </div>
			          	</div>
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="phone">Address<span class="red font-bold"> *</span></label>  
			               	<div class="col-md-7">
			               		{{ Form::textarea('txtbeneAddress', Input::old('txtbeneAddress'), array('class'=>'form-control input-md address','placeholder'=>'Address', 'required' => 'true', 'id'=>'address')) }}      
			               	</div>
			          	</div>
		          	</div>

					<div class="col-md-6">
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Gender<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				            	 {{ Form::radio('txtbeneSex','male','', array('id'=>'first1')) }}
				                  {{ Form::label('male','Male', array('style' => 'font-weight:normal'))}} 
				                  {{ Form::radio('txtbeneSex','female','', array('id'=>'first2')) }}
				                 {{ Form::label('female','Female', array('style' => 'font-weight:normal;')) }} 
				            </div>
			          	</div>
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Date of Birth<span class="red font-bold"> *</span></label>  
					        <div class="col-md-7 input-append date pull-right" id="dp1" data-date="" data-date-format="dd-mm-yyyy">
					            <!-- <input name="dob" id="dob" class="span2" size="16" type="text" value="" readonly /> -->
					            {{ Form::text('dtdateofBirth', Input::old('dtdateofBirth'), array('class' => 'span2', 'id' => 'dob', 'size'=>'16', 'readonly' => 'true') ) }}
					            <label class="add-on"><i class="icon-calendar"></i></label>
					        </div>
			          	</div>

			          	<div class="form-group sms">
				            <label class="col-md-5 control-label" for="age">Age</label>
				            <div class="col-md-7 radio_sms" style="font-size:12px;padding-right:0;">
			              	<!-- 	<input name="age" value="" readonly id="age"/ value="">  -->
			              		{{ Form::text('intbeneAge', Input::old('intbeneAge'), array('id' => 'age', 'readonly' => 'true') ) }}
			              		<img rel="tooltip" src="/assets/images/con_info.png" title="" />
				            </div> 
			      		</div>
		      			<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Category<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				          		{{ Form::select('intbeneCategory', $category, Input::old('intbeneCategory'), array('class' => 'form-control input-md', 'required' => 'true')) }}    
				            </div>
			          	</div>
		          		<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Application For<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				          		{{ Form::select('applicationfor', $details['applicationFor'], Input::old('applicationfor'), array('class' => 'form-control input-md', 'required' => 'true')) }}    
				            </div>
			          	</div>
					</div>
					
		          	<div class="form-group col-md-12" style="width:99%;margin-right:27px;">
		          		<label class="col-md-3 col-custom control-label" for="phone">District<span class="red font-bold"> *</span></label>  
			            <div class="col-md-3 col-custom1">
			              {{ Form::select('intbeneDistrict', $districts, Input::old('intbeneDistrict'), array('class' => 'form-control input-md', 'required' => 'true', 'id'=>'district_id')) }}  
			            </div>
			             <div class="col-md-3 col-custom1">
			              {{ Form::select('intbeneTaluk', $taluks, Input::old('intbeneTaluk'), array('class' => 'form-control input-md state', 'required' => 'true', 'id'=>'taluk_id')) }}     
			            </div>
			            <div class="col-md-3 col-custom1">
			              {{ Form::select('intbeneRSK', $hoblis, Input::old('intbeneRSK'), array('class' => 'form-control input-md state', 'required' => 'true', 'id'=>'hobli')) }}  
			            </div>
			            <div class="col-md-2 col-custom1">
			              {{ Form::select('intbeneVillage', $details['villages'], Input::old('intbeneVillage'), array('class' => 'form-control input-md state', 'required' => 'true', 'id'=>'village_id')) }}  
			            </div>
		          	</div>

		          	<div class="col-md-6">
		          		<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Pincode<span class="red font-bold"> *</span> </label>  
				            <div class="col-md-7">
				          		{{ Form::text('intbenePinCode', Input::old('intbenePinCode'), array('class'=>'form-control input-md','placeholder'=>'zip', 'maxlength'=>'6', 'minlength'=>'6', 'id' => 'zip', 'required' => 'true')) }}      
				            </div>
		          		</div>
	          		</div>

		            <div class="form-group">
		              <label class="col-md-3 control-label" for="submit"></label>
		              <div class="col-md-3">
		                <button id="submit_userform" name="submit" class="btn btn-lg btn-success btn-block">Update & Continue</button>
		              </div>
		            </div>
	      		</fieldset>
	          {{ Form::close() }}
	    </div>


	    <div id="crops" class="tab-pane <?php echo $active5; ?>">   
         	 {{ Form::model($crop, array('route' => array('users.update', $id), 'method' => 'PUT', 'class' => 'form-horizontal col-md-12' )) }}
         		<fieldset id="fieldsetappend">
         		  <input name="corps" class="none" type="hidden" value="1" />
         	 		<div class="form-group">
		              	<div class="col-md-5 form-group">
		                	{{ 'Fields marked as <span class="red font-bold"> *</span> are mandatory' }}
		              	</div>
		              	<div class="col-md-12">
			              	<?php if($id){ ?>
								<input name="beneficiary_id" class="none" type="hidden" value="<?php echo $id; ?>" />
								<input name="seniorMemberID" class="none" type="hidden" value="<?php echo $seniorMemberID; ?>" />
		  						<b>Beneficiary Member ID:</b> {{$seniorMemberID}} <b>Beneficiary Name:</b> {{$name}} <br>
			              	<?php } ?>
			              	@if($active2)
			              		<input name="category" id="category" class="none" type="hidden" value="<?php echo Session::get('category_id'); ?>" />
		              		@endif
		              	</div>
		            </div>
		
		           
		            <div class="col-md-6">
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Area<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
		              			{{ Form::text('area', Input::old('area'), array('class'=>'form-control input-md', 'required' => 'true')) }}
		              		</div>
	              		</div>
              		    <div class="form-group">
			              <label class="col-md-5 control-label" for="first_name">Holdings<span class="red font-bold"> *</span> </label>  
			              <div class="col-md-7">
			              {{ Form::select('holding_id[]', $details['holdings'], $details['holding_ids'], array('class'=>'form-control input-md', 'required' => 'true', 'multiple' => 'true')) }}
			              </div>
			            </div>
			            <div class="form-group">
			              <label class="col-md-5 control-label" for="last_name">Irrigation Source<span class="red font-bold"> *</span></label>  
			              <div class="col-md-7">
			              {{ Form::select('irrigation_id[]', $details['irrigationSources'], $details['irrigation_ids'], array('class'=>'form-control input-md', 'required' => 'true', 'multiple' => 'true')) }}  
			              </div>
			            </div>

		                <div class="form-group">
			                <label class="col-md-5 control-label" for="submit"></label>
			                <div class="col-md-7">
			                	<button id="submit" name="submit" class="btn btn-lg btn-success btn-block">Save & Continue</button>
			              	</div>
	            		</div>
            		</div>
            		<div class="col-md-6">
			          
              		  	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Survey No<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              	{{ Form::text('survey_no', Input::old('survey_no'), array('class'=>'form-control input-md', 'required' => 'true')) }}  
              				</div>
		            	</div>

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="last_name">Items<span class="red font-bold"> *</span></label>  
			              <div class="col-md-7">
			              {{ Form::select('item_id[]', $details['items'], $details['item_ids'], array('class'=>'form-control input-md', 'required' => 'true', 'multiple' => 'true')) }}  
			              </div>
			            </div>
	            	</div>
	      		</fieldset>
	        {{ Form::close() }}
        </div>

	    <div id="product" class="tab-pane <?php echo $active2; ?>">   
         	 {{ Form::model($product, array('route' => array('users.update', $id), 'method' => 'PUT', 'class' => 'form-horizontal col-md-12' )) }}
	            <fieldset id="fieldsetappend" >
	            <input name="add_product" class="none" type="hidden" value="1" />
		            <div class="form-group">
		              	<div class="col-md-5 form-group">
		                	{{ 'Fields marked as <span class="red font-bold"> *</span> are mandatory' }}
		              	</div>

		              	<div class="col-md-12">
			              		<?php if($id){ ?>
									<input name="beneficiary_id" class="none" type="hidden" value="<?php echo $id; ?>" />
									<input name="seniorMemberID" class="none" type="hidden" value="<?php echo $seniorMemberID; ?>" />
		  							<b>Beneficiary Member ID:</b> {{$seniorMemberID}} <b>Beneficiary Name:</b> {{$name}} <br><br>
				        		<?php } ?>
			              	@if($active2)
				              	<input name="category" id="category" class="none" type="hidden" value="<?php echo Session::get('category_id'); ?>" />
		              		@endif
	              		</div>
		            </div>
		
		            <div class="col-md-6">
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Product<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
		              			{{ Form::select('intProdID', $intProdID, Input::old('intProdID'), array('class'=>'form-control input-md', 'required' => 'true', 'id' => 'product_id')) }}
		              		</div>
	              		</div>
              		  	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Manufacturer<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              	{{ Form::select('intManufacturerID', $intManufacturerIDs, Input::old('intManufacturerID'), array('class'=>'form-control input-md', 'required' => 'true', 'id'=>'manufacturer_id')) }}  
              				</div>
		            	</div>

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="first_name">Model<span class="red font-bold"> *</span> </label>  
			              <div class="col-md-7">
			              {{ Form::select('intModelID', $intModelIDs, Input::old('intModelID'), array('class'=>'form-control input-md', 'required' => 'true', 'id' => 'model_id')) }}
			              </div>
			            </div>

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="last_name">Specification<span class="red font-bold"> *</span></label>  
			              <div class="col-md-7">
			              {{ Form::select('intSpecID', $intSpecIDs, Input::old('intSpecID'), array('class'=>'form-control input-md', 'required' => 'true', 'id'=>'spec_id')) }}  
			              </div>
			            </div>
				
						<div class="form-group">
				            <label class="col-md-5 control-label" for="graduation">Full Rate<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				            	{{ Form::text('decFullRate', Input::old('decFullRate'), array('class'=>'form-control input-md', 'placeholder'=>'', 'required' => 'true', 'id'=>'fullRate', 'readonly'=>'true')) }}  
							</div>
						</div>	
		            </div>

    	            <div class="col-md-6">
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Government Share<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
		              			{{ Form::text('decGovtShare', Input::old('decGovtShare'), array('class'=>'form-control input-md', 'required' => 'true', 'id'=>'govtShare', 'readonly'=>'true')) }}
		              		</div>
	              		</div>
              		  	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Farmer's Share<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              	{{ Form::text('decFarmerShare', Input::old('decFarmerShare'), array('class'=>'form-control input-md','placeholder'=>'', 'required' => 'true', 'id'=>'farmerShare', 'readonly'=>'true')) }}  
              				</div>
		            	</div>

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="first_name">Quantity<span class="red font-bold"> *</span> </label>  
			              <div class="col-md-7">
			              {{ Form::text('intQty', Input::old('intQty'), array('class'=>'form-control input-md integer_field', 'placeholder'=>'', 'required' => 'true')) }}
			              </div>
			            </div>

			            <div class="form-group">
			              <label class="col-md-5 control-label" for="last_name">Unit<span class="red font-bold"> *</span></label>  
			              <div class="col-md-7">
			              {{ Form::select('intUnitofMeasure', $uom, Input::old('intUnitofMeasure'), array('class'=>'form-control input-md', 'required' => 'true', 'id'=>'UOM')) }}  
			              </div>
			            </div>
				
		            </div>
		          
					<!-- Button -->
		            <div class="form-group">
		              <label class="col-md-3 control-label" for="submit"></label>
		              <div class="col-md-3">
		                <button id="submit" name="submit" class="btn btn-lg btn-success btn-block">Update & Continue</button>
		              </div>
		            </div>
	      		</fieldset>
	     {{Form::close()}}
	    </div>

	    <div id="documents" class="tab-pane <?php echo $active3; ?>">   
			{{ Form::model($documents, array('route' => array('users.update', $id), 'method' => 'PUT', 'class' => 'form-horizontal col-md-12', 'enctype'=>'multipart/form-data')) }}
         		<input name="add_documents" class="none" type="hidden" value="1" />
	            <fieldset id="fieldsetappend" >
		            <div class="form-group">
		              	<div class="col-md-5">
		                	{{ 'Fields marked as <span class="red font-bold"> *</span> are mandatory' }}
		              	</div>
		            </div>
		            <div class="col-md-12">
							<?php if($id){ ?>
									<input name="beneficiary_id" class="none" type="hidden" value="<?php echo $id; ?>" />
									<input name="seniorMemberID" class="none" type="hidden" value="<?php echo $seniorMemberID; ?>" />
		  							<b>Beneficiary Member ID:</b> {{$seniorMemberID}} <b>Beneficiary Name:</b> {{$name}}<br><br>
				        	<?php } ?>
			        </div>
		          	{{ HTML::image($txtDocPath, 'a picture') }}
		            <div class="col-md-6">

	              		<div class="form-group">
				            <label class="col-md-4 control-label" for="photo" required="true">Upload New Photo<span class="red font-bold"> *</span></label>
				            <div class="col-md-6">
				              {{ Form::file('photo', array('class'=>'form-control input-md', 'required' => 'true')) }}
				            </div>
			          	</div>
			          	<div class="form-group">
				            <label class="col-md-4 control-label" for="rtc">RTC</label>
				            <div class="col-md-6">
				              {{ Form::file('rtc', array('class'=>'form-control input-md', 'required' => 'true')) }}
				            </div>
			          	</div>

			          	<div class="form-group">
				            <label class="col-md-4 control-label" for="bank_passbook_copy" required="true">Bank Passbook Copy</label>
				            <div class="col-md-6">
				              {{ Form::file('bank_passbook_copy', array('class'=>'form-control input-md', 'required' => 'true')) }}
				            </div>
			          	</div>

			          	<div class="form-group">
				            <label class="col-md-4 control-label" for="cash_certifcate" required="true">Cash Certifcate</label>
				            <div class="col-md-6">
				              {{ Form::file('cash_certifcate', array('class'=>'form-control input-md', 'required' => 'true')) }}
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
	        {{Form::close()}}
	    </div>

	    <div id="payment" class="tab-pane <?php echo $active4; ?>">   
         	{{ Form::model($user, array('route' => array('users.update', $id), 'method' => 'PUT', 'class' => 'form-horizontal col-md-12')) }}
	            <fieldset id="fieldsetappend" >
		            <div class="form-group">
		              	<div class="col-md-5">
		                	{{ 'Fields marked as <span class="red font-bold"> *</span> are mandatory' }}
		              	</div>
		            </div>
		            <input name="payment_detail" class="none" type="hidden" value="1" />
		            <div class="col-md-12">
			           	<?php if($id){ ?>
									<input name="beneficiary_id" class="none" type="hidden" value="<?php echo $id; ?>" />
									<input name="seniorMemberID" class="none" type="hidden" value="<?php echo $seniorMemberID; ?>" />
		  							<b>Beneficiary Member ID:</b> {{$seniorMemberID}} <b>Beneficiary Name:</b> {{$name}}<br><br>
				        <?php } ?>
			        </div>
					
		            <div class="col-md-6">
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Payment Type<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
		              			{{ Form::select('intbeneModeofPayment', array(''=>'--Select type--', '1'=>'Cheque', '2'=>'DD', '3'=>'Other'), Input::old('intbeneModeofPayment'), array('class'=>'form-control input-md', 'required' => 'true')) }}
		              		</div>
	              		</div>
              		  	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Cheque/DD No<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              	{{ Form::text('txtbeneDDChequeNo', Input::old('txtbeneDDChequeNo'), array('class'=>'form-control input-md','placeholder'=>'', 'required' => 'true')) }}  
              				</div>
		            	</div>
		            	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Account No<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              	{{ Form::text('accountNo', Input::old('accountNo'), array('class'=>'form-control input-md','placeholder'=>'', 'required' => 'true')) }}  
              				</div>
		            	</div>

	            		<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Bank<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				          		{{ Form::select('bankID', $details['bank'], Input::old('bankID'), array('class' => 'form-control input-md', 'required' => 'true')) }}    
				            </div>
			          	</div>

		            	<div class="form-group">
				            <label class="col-md-5 control-label" for="">Amount Recieved<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				              	{{ Form::text('intbeneAmtReceived', Input::old('intbeneAmtReceived'), array('class'=>'form-control input-md','placeholder'=>'', 'required' => 'true')) }}  
              				</div>
		            	</div>

		            	<div class="form-group">
		              		<label class="col-md-3 control-label" for="submit"></label>
			              	<div class="col-md-3">
		                		<button id="submit" name="submit" class="btn btn-lg btn-success btn-block">Save</button>
		              		</div>
			            </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Recommended By<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				          		{{ Form::select('recommendedBy', $details['recommendedBy'], Input::old('recommendedBy'), array('class' => 'form-control input-md', 'required' => 'true', 'id' => 'recommended_by')) }}    
				            </div>
			          	</div>

			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Recommended From<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				          		{{ Form::select('recommendedFrom', $details['recommendedFrom'], Input::old('recommendedFrom'), array('class' => 'form-control input-md', 'required' => 'true', 'id' => 'recommended_from')) }}    
				            </div>
			          	</div>
			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Payment Date<span class="red font-bold"> *</span></label>  
					        <div class=" col-md-7 input-append date pull-right" id="dp2" data-date="" data-date-format="dd-mm-yyyy">
					        {{ Form::text('paymentDate', Input::old('paymentDate'), array('class' => 'span2', 'size'=>'16', 'readonly' => 'true') ) }}
					            <label class="add-on"><i class="icon-calendar"></i></label>
					        </div>
			          	</div>

			          	<div class="form-group">
				            <label class="col-md-5 control-label" for="twelfth">Amount Remitted<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				            	 {{ Form::radio('flgbeneisAmountRemitted','1','', array('id'=>'first1')) }}
				                  {{ Form::label('1','Received', array('style' => 'font-weight:normal'))}} 
				                  {{ Form::radio('flgbeneisAmountRemitted','0','', array('id'=>'first2')) }}
				                 {{ Form::label('0','Not yet', array('style' => 'font-weight:normal;')) }} 
				            </div>
			          	</div>
		            </div>
	      		</fieldset>
	        {{  Form::close() }}
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

</div>

@stop