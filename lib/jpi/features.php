<?php
namespace lib\jpi;


class features
{
	public static function pay($_args)
	{
		$result = jpi::features_pay($_args);

		var_dump($result);exit;

	}
}
?>