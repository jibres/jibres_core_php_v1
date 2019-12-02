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
			if(isset($store_detail['fuel']))
			{
				$myFuel             = \dash\engine\fuel::get($store_detail['fuel']);
				$myFuel['database'] = \dash\db::$store_db_name;
			}
			else
			{
				$myFuel             = \dash\engine\fuel::get();
				$myFuel['database'] = \dash\db::$store_db_name;
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
