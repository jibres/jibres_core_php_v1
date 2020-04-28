<?php
namespace lib\shaparak;

class acceptor
{
	private static $switchKiccc                = 581672111;
	private static $codePazirandegiPardakhtYar = 371961754012345;


	public static function get_iin()
	{
		return self::$switchKiccc;
	}


	public static function get_facilitatorAcceptorCode()
	{
		return self::$codePazirandegiPardakhtYar;
	}
}
?>