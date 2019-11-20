<?php
namespace lib\app\setting;


class setup
{
	private static $setting_cat = 'setup';


	public static function complete($_set_complete = false)
	{
		// if complete setup return true
		return true;
		return false;
	}


	public static function next_level($_current_level = null)
	{
		$order =
		[
			'owner',
			'logo',
			'address',
			'barcode',
			'scale',
			'vat',
		];

		if($_current_level)
		{
			if(in_array($_current_level, $order))
			{
				$current_level_key = array_search($_current_level, $order);
				$next_level_key = $current_level_key + 1;
				if(isset($order[$next_level_key]))
				{
					return $order[$next_level_key];
				}
				else
				{
					return null;
				}
			}
			else
			{
				return $order[0];
			}
		}
		else
		{
			return $order[0];
		}
	}

	public static function owner()
	{

	}


	public static function logo()
	{

	}

	public static function address()
	{

	}


	public static function barcode()
	{

	}

	public static function scale()
	{

	}

	public static function vat()
	{

	}




}
?>