<?php

class Mstproductname extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'mstproductname';

	public static function getProductList()
	{
		$productList = array('' => '--Select product--') + DB::table('mstproductname')
							->where('flgisActive', 1)
							->orderBy('txtProdName', 'ASC')->lists('txtProdName', 'intProdID');
		
		return $productList;
	}

	public static function getApplicationFor()
	{
		$applicationList = array('' => '--Select application for--') + DB::table('mstapplicationfor')
							->where('flgisActive', 1)
							->orderBy('txtApplication', 'ASC')->lists('txtApplication', 'id');
		
		return $applicationList;
	}

	public static function getBankList()
	{
		$bankList = array('' => '--Select bank--') + DB::table('mstbank')
							->where('flgisActive', 1)
							->orderBy('txtBankName', 'ASC')->lists('txtBankName', 'id');
		
		return $bankList;
	}

	public static function getrecommendedByList()
	{
		$recommendedbyList = array('' => '--Select recommended by--') + DB::table('mstrecommendedby')
							->where('flgisActive', 1)
							->orderBy('recommendedBy', 'ASC')->lists('recommendedBy', 'id');
		
		return $recommendedbyList;
	}

	public static function getrecommendedFromList($recommended_by = null)
	{
		$recommendedfromList = DB::table('mstrecommendedfrom')
							->where('flgisActive', 1)
							->where('recommendedBy', $recommended_by)
							->orderBy('recommendedFrom', 'ASC')->lists('recommendedFrom', 'id');
		
		return $recommendedfromList;
	}
	
}