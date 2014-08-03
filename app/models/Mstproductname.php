<?php

class Mstproductname extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'mstproductname';

	public static function getProductList()
	{
		$productList = array(0 => '--Select product--') + DB::table('mstproductname')
							->where('flgisActive', 1)
							->orderBy('txtProdName', 'ASC')->lists('txtProdName', 'intProdID');
		
		return $productList;
	}
	
	
}