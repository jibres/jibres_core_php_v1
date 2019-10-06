<?php
namespace lib\pardakhtyar;

class type
{
	// in document
	// page 45
	// 4-5 | 1-4-5
	public static function status()
	{
		$list     = [];
		$list[5]  = ['title' => T_("Cancel"), ];
		$list[8]  = ['title' => T_("Awaiting"), ];
		$list[12] = ['title' => T_("Delay"), ];
		$list[14] = ['title' => T_("Ok"), ];
		return $list;
	}


	public static function terminalType()
	{
		$list   = [];
		$list[] = ['index' => 0, 'key' => 'romizi', 'title' => 'پایانه رومیزی',];
		$list[] = ['index' => 1, 'key' => 'enternet', 'title' => 'درگاه پرداخت اینترنتی',];
		$list[] = ['index' => 2, 'key' => 'mobile', 'title' => 'درگاه پرداخت موبایلی',];
		$list[] = ['index' => 2, 'key' => 'bisim', 'title' => 'پایانه فروش بی سیم',];
		return $list;
	}



	public static function etrustCertificateType()
	{
		$list   = [];
		$list[] = ['index' => 0, 'key' => 'onestar', 'title' => T_('One star'),];
		$list[] = ['index' => 1, 'key' => 'twostar', 'title' => T_('Two star'),];
		return $list;
	}

	public static function businessType()
	{
		$list   = [];
		$list[] = ['index' => 0, 'key' => 'physical', 'title' => T_('Physical'),];
		$list[] = ['index' => 1, 'key' => 'physical-virtual', 'title' => T_('Physical and Virtual'),];
		$list[] = ['index' => 2, 'key' => 'virtual', 'title' => T_('Virtual'),];
		return $list;
	}


	public static function ownershipType()
	{
		$list   = [];
		$list[] = ['index' => 0, 'key' => 'owner', 'title' => T_('Owner'),];
		$list[] = ['index' => 1, 'key' => 'tenant', 'title' => T_('Tenant'),];
		return $list;
	}



	public static function birthCrtfctSeriesLetter()
	{
		$list   = [];
		$list[] = ['index' => 0,  'key' => 'A', 'title' => T_('A'),];
		$list[] = ['index' => 1,  'key' => 'B', 'title' => T_('B'),];
		$list[] = ['index' => 2,  'key' => 'L', 'title' => T_('L'),];
		$list[] = ['index' => 3,  'key' => 'D', 'title' => T_('D'),];
		$list[] = ['index' => 4,  'key' => 'R', 'title' => T_('R'),];
		$list[] = ['index' => 5,  'key' => '1', 'title' => T_('1'),];
		$list[] = ['index' => 6,  'key' => '2', 'title' => T_('2'),];
		$list[] = ['index' => 7,  'key' => '3', 'title' => T_('3'),];
		$list[] = ['index' => 8,  'key' => '4', 'title' => T_('4'),];
		$list[] = ['index' => 9,  'key' => '9', 'title' => T_('9'),];
		$list[] = ['index' => 10, 'key' => '10', 'title' => T_('10'),];
		$list[] = ['index' => 11, 'key' => '11', 'title' => T_('11'),];
		$list[] = ['index' => 12, 'key' => 'SH', 'title' => T_('SH'),];

		return $list;
	}



	public static function vitalStatus()
	{
		$list   = [];
		$list[] = ['index' => 0, 'key' => 'live', 'title' => T_('Live'),];
		$list[] = ['index' => 1, 'key' => 'dead', 'title' => T_('Dead'),];
		return $list;
	}


	public static function residencyType()
	{
		$list   = [];
		$list[] = ['index' => 0, 'key' => 'iranian', 		'title' => T_('Iranian'),];
		$list[] = ['index' => 1, 'key' => 'non-iranian',	'title' => T_('Non iranian'),];
		return $list;
	}


	public static function gender()
	{
		$list   = [];
		$list[] = ['index' => 0, 'key' => 'female', 'title' => T_('Female'),];
		$list[] = ['index' => 1, 'key' => 'male',	'title' => T_('Male'),];
		return $list;
	}


	public static function merchantType()
	{
		$list   = [];
		$list[] = ['index' => 0, 'key' => 'real', 	'title' => T_('Real'),];
		$list[] = ['index' => 1, 'key' => 'legal',	'title' => T_('Legal'),];
		return $list;
	}


	public static function __callStatic($_fn, $_args)
	{
		$key     = isset($_args[0]) ? $_args[0] : null;
		$selfFn  = null;
		$data    = null;
		$get_key = null;

		if(substr($_fn, 0, 6) === 'title_')
		{
			$get_key = substr($_fn, 0, 5);
			$selfFn  = substr($_fn, 6);
		}
		elseif(substr($_fn, 0, 6) === 'index_')
		{
			$get_key = substr($_fn, 0, 5);
			$selfFn  = substr($_fn, 6);
		}
		else
		{
			return false;
		}

		if(!is_callable(['self', $selfFn]))
		{
			return false;
		}

		$data    = self::$selfFn();

		if(!is_array($data))
		{
			return false;
		}

		$mydata = null;

		foreach ($data as $value)
		{
			if($get_key === 'title')
			{
				if(isset($value['index']) && $value['index'] == $key)
				{
					$mydata = isset($value['title']) ? $value['title'] : null;
					break;
				}
			}
			elseif($get_key === 'index')
			{
				if(isset($value['key']) && $value['key'] == $key)
				{
					$mydata = isset($value['index']) ? $value['index'] : null;
					break;
				}
			}
		}

		return $mydata;
	}
}
?>