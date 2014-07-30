<?php

class Msttaluk extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'msttaluk';

	public static function getTalukList($district_id = null)
	{

		$talukList = array(NULL => '--Select taluk--') + DB::table('msttaluk') 
							->where('intDistrictID', $district_id)
							->where('flgisActive', 1)
							->orderBy('txtTalukName', 'ASC')->lists('txtTalukName', 'intTalukID');
		
		return $talukList;
	}
}