<?php

class Trnbeneficiaryproddetails extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'trnbeneficiaryproddetails';

	public static function getManufacturerList($product_id = null)
	{

		$manufacturer =  DB::table('mstmanufacturer')->where('flgisActive', 1); 

		if($product_id) $manufacturer->where('intProdID', $product_id);

		$manufacturer = $manufacturer->orderBy('txtManufacturerName', 'ASC')->lists('txtManufacturerName', 'intManuID');

		return $manufacturer;
	}

	public static function getModelList($manufacturer_id = null)
	{

		$model = DB::table('mstmodel')->where('flgisActive', 1);

		if($manufacturer_id) $model->where('intManuID', $manufacturer_id);

		$model = $model->orderBy('txtModelName', 'ASC')->lists('txtModelName', 'intModelID');

		return $model;
	}

	public static function getSpecList($model_id = null)
	{

		$spec =  DB::table('mstspecification')->where('flgisActive', 1);

		if($model_id) $spec->where('intModelID', $model_id);

		$spec = $spec->orderBy('txtSpecification', 'ASC')->lists('txtSpecification', 'intSpecID');
		
		return $spec;
	}


	
}