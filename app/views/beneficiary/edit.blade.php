@extends('layouts.main')
@section('content')
<div class="container">
  
  <ul id="tabs" class="nav nav-tabs bold" data-tabs="tabs">
    <li class="active"><a href="{{ URL::to('franchise') }}">Editing a product</a></li>
    <li><a href="/franchise">Products List</a> </li>
    <li><a href="{{ URL::to('users') }}">Back</a></li>
  </ul>

  <h3>Edit a product</h3>
  <!-- if there are creation errors, they will show here -->
  {{ HTML::ul($errors->all()) }}

          {{ Form::model($franchise, array('route' => array('franchise.update', $franchise->id), 'method' => 'PUT', 'class' => 'form-horizontal col-md-12',
          'id' => 'productform' )) }}

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
                  {{ Form::text('product_validity_period', Input::old('product_validity_period'), array('class'=>'form-control input-md', 'placeholder'=>'product validity', 'required' => 'true')) }}
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="last_name">Product Price<span class="red font-bold"> *</span></label>  
                  <div class="col-md-5">
                  {{ Form::text('product_price', Input::old('product_price'), array('class'=>'form-control input-md', 'placeholder'=>'product price', 'required' => 'true')) }}  
                  </div>
                </div>
               <div class="form-group">
                  <label class="col-md-3 control-label" for="graduation">Franchise<span class="red font-bold"> *</span></label>  
                  <div class="col-md-6">
                    {{ Form::select('franchise_ids[]', $franchise_list, $franchise_ids, array('class' => 'form-control input-md', 'required' => 'true', 'id' => 'franchise_id', 'multiple' => 'multiple')) }}
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
                    <button id="submit" name="submit" class="btn btn-lg btn-success btn-block"> Update </button>
                  </div>
                </div>
            </fieldset>

      {{ Form::close() }}

</div>
@stop