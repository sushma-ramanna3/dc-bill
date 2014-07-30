@extends('layouts.main')
@section('content')
 
  	<h3>Dashboard</h3>

  	<ul id="tabs" class="nav nav-tabs bold" data-tabs="tabs">
  		@if(Auth::check() && Auth::user()->usertype == 'admin')
  			<li class="active"><a href="#product" data-toggle="tab">Add Products</a></li>
  			<li><a href="{{ URL::to('franchise') }}">Products list</a></li>
  		@else
  		 	<li class="active tab"><a href="#users" data-toggle="tab">User Registration</a></li>
		    <li class="tab"><a href="#products" data-toggle="tab">Product Purchase</a></li>
		    <li class="users tab"><a href="#documents" data-toggle="tab">User Documents</a></li>
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
			           <!--  <div class="form-group email_div">
			              <label class="col-md-5 control-label" for="email">Email ID<span class="red font-bold"> *</span></label>  
			              <div class="col-md-7">
			              {{ Form::email('email', Input::old('email'), array('class'=>'form-control input-md','placeholder'=>'enter your email', 'required' => 'true', 'id' => 'email')) }}  
			              </div>
			              <input id="user_exist" name="user_exist" class="none" type="hidden" value=""/>
			            </div> -->
			
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
				            <label class="col-md-5 control-label" for="twelfth">Gender<span class="red font-bold"> *</span></label>  
				            <div class="col-md-7">
				            	 {{ Form::radio('q1','male','', array('id'=>'first1')) }}
				                  {{ Form::label('male','Male', array('style' => 'font-weight:normal'))}} 
				                  {{ Form::radio('q1','female','', array('id'=>'first2')) }}
				                 {{ Form::label('female','Female', array('style' => 'font-weight:normal;')) }} 
				            </div>
			          	</div>
			          
						<!-- Text input-->
			          	<div class="form-group purchase">
				            <label class="col-md-5 control-label" for="twelfth">Date of Birth<span class="red font-bold"> *</span></label>  
					            <div class=" col-md-7 input-append date pull-right" id="dp2" data-date="" data-date-format="dd-mm-yyyy">
					              <input name="from_date" class="span2" size="16" type="text" value="" readonly />
					              <label class="add-on"><i class="icon-calendar"></i></label>
					            </div>
				            
			          	</div>

			          	<div class="form-group sms">
				            <label class="col-md-5 control-label" for="resume">Age<span class="red font-bold"> *</span></label>
				            <div class="col-md-7 radio_sms" style="font-size:12px;padding-right:0;">
			              		<input name="age" value="" disabled="true" />
				            </div> 
			      		</div>
					</div>
					
					<div class="form-group purchase col-md-12" style="width:99%;margin-right:27px;">
			            <label class="col-md-3 col-custom control-label" for="phone">Address<span class="red font-bold"> *</span></label>  
		               	<div class="col-md-3">
		               		{{ Form::textarea('address', Input::old('address'), array('class'=>'form-control input-md address','placeholder'=>'Address', 'required' => 'true', 'id'=>'address')) }}      
		               	</div>
		          	</div>

		          	<div class="form-group purchase col-md-12" style="width:99%;margin-right:27px;">
		          		<label class="col-md-3 col-custom control-label" for="phone">District<span class="red font-bold"> *</span></label>  
			            <div class="col-md-3">
			              {{ Form::select('district', $districts, Input::old('district'), array('class' => 'form-control input-md state', 'required' => 'true', 'id'=>'district')) }}  
			            </div>
			             <div class="col-md-2">
			              {{ Form::select('taluk', $taluks, Input::old('taluk'), array('class' => 'form-control input-md state', 'required' => 'true', 'id'=>'taluk')) }}     
			            </div>
			            <div class="col-md-2">
			              {{ Form::select('hoblirsk', $hoblirsk, Input::old('hoblirsk'), array('class' => 'form-control input-md state', 'required' => 'true', 'id'=>'hobli')) }}  
			            </div>
			            <div class="col-md-2">
			              {{ Form::text('zip', Input::old('zip'), array('class'=>'form-control input-md','placeholder'=>'zip', 'maxlength'=>'6', 'minlength'=>'6', 'id' => 'zip', 'required' => 'true')) }}      
			            </div>
		          	</div>

		            <div class="form-group">
		              <label class="col-md-3 control-label" for="submit"></label>
		              <div class="col-md-3">
		                <button id="submit_userform" name="submit" class="btn btn-lg btn-success btn-block"> Submit </button>
		              </div>
		            </div>
	      		</fieldset>
	        </form>
	    </div>

	    <div id="product" class="tab-pane">   
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
		              <label class="col-md-3 control-label" for="first_name">Product<span class="red font-bold"> *</span> </label>  
		              <div class="col-md-5">
		              {{ Form::select('intProdID', $intProdID, Input::old('intProdID'), array('class'=>'form-control input-md','placeholder'=>'product', 'required' => 'true')) }}
		              </div>
		            </div>

		            <!-- Text input-->
		            <div class="form-group">
		              <label class="col-md-3 control-label" for="last_name">Manufacturer<span class="red font-bold"> *</span></label>  
		              <div class="col-md-5">
		              {{ Form::select('intManufacturerID', $intManufacturerID, Input::old('intManufacturerID'), array('class'=>'form-control input-md','placeholder'=>'', 'required' => 'true')) }}  
		              </div>
		            </div>

		             <!-- Text input-->
		            <div class="form-group">
		              <label class="col-md-3 control-label" for="first_name">Product Validity<small> (in days)</small><span class="red font-bold"> *</span> </label>  
		              <div class="col-md-5">
		              {{ Form::select('intModelID', $intModelID, Input::old('intModelID'), array('class'=>'form-control input-md integer_field', 'placeholder'=>'', 'required' => 'true')) }}
		              </div>
		            </div>

		            <!-- Text input-->
		            <div class="form-group">
		              <label class="col-md-3 control-label" for="last_name">Product Price<span class="red font-bold"> *</span></label>  
		              <div class="col-md-5">
		              {{ Form::select('intSpecID', $intSpecID, Input::old('intSpecID'), array('class'=>'form-control input-md integer_field', 'placeholder'=>'', 'required' => 'true')) }}  
		              </div>
		            </div>
			
					<div class="form-group">
			            <label class="col-md-3 control-label" for="graduation">Franchise<span class="red font-bold"> *</span></label>  
			            <div class="col-md-6">
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



</div>

@stop