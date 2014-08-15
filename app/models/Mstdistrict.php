<?php

class Mstdistrict extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'mstdistrict';

	public static function getDistrictList()
	{
		$districtList = array('' => '--Select district--') + DB::table('mstdistrict')
							->where('flgisActive', 1)
							->orderBy('txtDistrictName', 'ASC')->lists('txtDistrictName', 'intDistrictID');
		
		return $districtList;
	}
	
	
}