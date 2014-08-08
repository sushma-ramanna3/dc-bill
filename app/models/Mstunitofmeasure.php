<?php

class Mstunitofmeasure extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'mstunitofmeasure';

	public static function getUOM()
	{
		$uom = array('' => '--Select Unit--') + DB::table('mstunitofmeasure')
							->where('flgisActive', 1)
							->orderBy('txtUOM', 'ASC')->lists('txtUOM', 'intUomID');
		return $uom;
	}
	
	
}