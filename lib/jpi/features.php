<?php
namespace lib\jpi;


class features
{
	public static function pay($_args)
	{
		$result = jpi::features_pay($_args);

		return $result;

	}


	public static function sync()
	{
		$result = jpi::features_sync();
		return $result;
	}
}
?>