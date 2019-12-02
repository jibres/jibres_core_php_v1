<?php
namespace dash\engine;
/**
 * he is our detective to find store detail or jibres
 */
class detective
{
	public static function who($_force_fuel = null)
	{
		if(isset($_force_fuel['fuel']) && $_force_fuel['fuel'] && is_string($_force_fuel['fuel']))
		{
			$myFuel             = \dash\engine\fuel::get($_force_fuel['fuel']);

			if(isset($_force_fuel['database']) && $_force_fuel['database'])
			{
				$myFuel['database'] = $_force_fuel['database'];
			}

			return $myFuel;
		}
		else
		{
			if(\dash\engine\store::inStore())
			{
				// connect to store
				$store_detail = \dash\engine\store::store_detail();
				if(isset($store_detail['fuel']) && isset($store_detail['db_name']))
				{
					$myFuel             = \dash\engine\fuel::get($store_detail['fuel']);
					$myFuel['database'] = $store_detail['db_name'];
				}
				else
				{
					$myFuel             = \dash\engine\fuel::get();
				}

				return $myFuel;
			}
			else
			{
				// connect to jibres
				$myFuel = \dash\engine\fuel::master();
				return $myFuel;
			}
		}
	}
}
?>
