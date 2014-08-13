<?php

class Msttaluk extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'msttaluk';

	public static function getVillageList($hobli_id = null)
	{

		$talukList = DB::table('msttaluk') 
							->where('intHobliID', $hobli_id)
							->where('flgisActive', 1)
							->orderBy('txtTalukName', 'ASC')->lists('txtTalukName', 'intTalukID');
		
		return $talukList;
	}
}