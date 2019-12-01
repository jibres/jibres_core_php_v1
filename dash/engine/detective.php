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
			// $myFuel = \dash\engine\fuel::get();
			$storeDBName = \dash\db::$store_db_name;
			return $storeDBName;
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
