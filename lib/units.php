<?php
namespace lib;

class units {


	public static function mass()
	{
		$units =
		[
			'IRT' 	=> ['symbol' => 'IRT', 	'decimal_digits' => 0, 'code' => 'IRT', 'symbol_native' => 'تومان',	 'name' => T_('Iranian Toman')],
		];

		return $units;
	}


	public static function length()
	{
		$units =
		[
			'IRT' 	=> ['symbol' => 'IRT', 	'decimal_digits' => 0, 'code' => 'IRT', 'symbol_native' => 'تومان',	 'name' => T_('Iranian Toman')],
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
