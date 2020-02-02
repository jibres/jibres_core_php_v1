<?php
namespace lib\app\application;


class tools
{

	public static function save($_key, $_value)
	{
		\lib\app\setting\tools::update('application', $_key, $_value);
	}


	public static function get($_key)
	{
		$result = \lib\app\setting\tools::get('application', $_key);
		return $result;
	}

}
?>