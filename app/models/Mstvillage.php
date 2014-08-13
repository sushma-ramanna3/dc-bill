<?php

class Mstvillage extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'mstvillage';

	public static function getVillageList($hobli_id = null)
	{

		$villageList = DB::table('mstvillage') 
							->where('intHobliID', $hobli_id)
							->where('flgisActive', 1)
							->orderBy('txtVillageName', 'ASC')->lists('txtVillageName', 'intVillageID');
		
		return $villageList;
	}
}