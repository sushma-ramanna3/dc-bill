<?php

class Msthoblirsk extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'msthoblirsk';

	public static function getHoblirskList($taluk_id = null)
	{

		$hobliList = array(NULL => '--Select hobli RSK--') + DB::table('msthoblirsk')
							->where('intTalukID', $taluk_id)
							->where('flgisActive', 1)
							->orderBy('txtHobliRSK', 'ASC')->lists('txtHobliRSK', 'intHobliRSKID');
		
		return $hobliList;
	}
}