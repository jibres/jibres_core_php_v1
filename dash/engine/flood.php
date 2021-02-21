<?php
namespace dash\engine;

class flood
{
	private static $ipSecAddr = YARD.'jibres_ipsec/';

	public static function protection()
	{
		\dash\engine\ip::checkLimit();
	}
}
?>
