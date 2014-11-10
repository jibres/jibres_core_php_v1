<?php
class getTable_cls{
	public static function get($name){
		$ret = array();
		$table = sql_lib::getTable($name);
		foreach ($table as $key => $value) {
			array_push($ret, $key);
		}
		return $ret;
	}
}