<?php
namespace lib\app\premium\items\discount;


class discount_profesional
{
	public static function detail()
	{
		return
		[
			'comperatprice' => 2000,
			'price'         => 1000,
			'relase_date'   => '2021-10-24',
			'last_update'   => '2021-10-24',
			'title'         => T_("Profesional discount"),
			'description'   => self::description(),

		];

	}

	private static function description()
	{
		return T_("Description");
	}



}
?>