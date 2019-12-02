<?php
namespace dash\engine;
/**
 * he is our detective to find store detail or jibres
 */
class detective
{
	public static function who()
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
?>
