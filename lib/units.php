<?php
namespace lib;

class units {

	private static $length =
	[
		'cm' 	=> ['name' => 'Centimetre'],
		'mm' 	=> ['name' => 'Millimetre'],
		'in' 	=> ['name' => 'Inch'],
		'yd' 	=> ['name' => 'Yard'],
	];

	private static $mass =
	[
		'kg' 	=> ['name' => 'Kilogram'],
		'g' 	=> ['name' => 'Gram'],
		'lb' 	=> ['name' => 'Pound'],
		'oz' 	=> ['name' => 'Ounce'],
	];



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


	public static function list_pretty(string $_type)
	{
		if($_type === 'mass')
		{
			$list = self::$mass;
		}
		elseif($_type === 'length')
		{
			$list = self::$length;
		}
		else
		{
			return null;
		}

		$new_list = [];
		foreach ($list as $key => $value)
		{
			$new_list[$key] = T_($value['name']);
		}

		return $new_list;
	}



	public static function detail($_key, $_type)
	{
		if($_type === 'mass')
		{
			$list = self::$mass;
		}
		elseif($_type === 'length')
		{
			$list = self::$length;
		}
		else
		{
			return null;
		}

		if(isset($list[$_key]))
		{
			// if(isset($list[$_key]['name']))
			// {
			// 	$name  = $list[$_key]['name'];
			// 	\dash\engine\runtime::set('libStore', 'g1');
			// 	// calling t_ get many time!
			// 	$list[$_key]['name'] = T_($name);
			// 	\dash\engine\runtime::set('libStore', 'g2');
			// }

			return $list[$_key];
		}

		return null;
	}
}
?>