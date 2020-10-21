<?php
namespace lib\app\website\status;

class get
{
	public static function status()
	{
		$active_status = \lib\db\setting\get::platform_cat_key( 'website', 'status', 'active');
		if(!$active_status || !isset($active_status['value']))
		{
			return false;
		}

		return $active_status['value'];
	}


}
?>
