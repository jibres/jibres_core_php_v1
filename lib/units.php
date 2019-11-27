<?php
namespace lib;

class units {


	public static function mass()
	{

		$units =
		[
			'kg' 	=> ['name' => T_('Kilogram')],
			'g' 	=> ['name' => T_('Gram')],
			'lb' 	=> ['name' => T_('Pound')],
			'oz' 	=> ['name' => T_('Ounce')],
		];

		return $units;
	}


	public static function length()
	{
		$units =
		[
			'cm' 	=> ['name' => T_('Centimetre')],
			'mm' 	=> ['name' => T_('Millimetre')],
			'in' 	=> ['name' => T_('Inch')],
			'yd' 	=> ['name' => T_('Yard')],
		];

		return $units;
	}


	public static function detail($_key, $_type)
	{
		if($_type === 'mass')
		{
			$list = self::mass();
		}
		elseif($_type === 'length')
		{
			$list = self::length();
		}
		else
		{
			return null;
		}

		if(isset($list[$_key]))
		{
			return $list[$_key];
		}

		return null;
	}
}
?>
