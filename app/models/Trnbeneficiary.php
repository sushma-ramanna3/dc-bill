<?php

class Trnbeneficiary extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'trnbeneficiary';

	public static function getirrigationSources()
	{
		$irrigationList = array('' => '--Select irrigation sources--') + DB::table('mstirrigationsources')
							->where('flgisActive', 1)
							->orderBy('irrigation_source', 'ASC')->lists('irrigation_source', 'id');
		
		return $irrigationList;
	}

	public static function getHoldings()
	{
		$holdingsList = array('' => '--Select holdings--') + DB::table('mstholdings')
							->where('flgisActive', 1)
							->orderBy('holdings', 'ASC')->lists('holdings', 'id');
		
		return $holdingsList;
	}

	public static function getItems()
	{
		$itemsList = array('' => '--Select items--') + DB::table('mstitems')
							->where('flgisActive', 1)
							->orderBy('items', 'ASC')->lists('items', 'id');
		
		return $itemsList;
	}

}