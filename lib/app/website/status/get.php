<?php
namespace lib\app\website\status;

class get
{
	public static function status()
	{
		$active_status = \lib\db\setting\get::lang_platform_cat_key(\dash\language::current(), 'website', 'status', 'active');
		if(!$active_status || !isset($active_status['value']))
		{
			return false;
		}

		return $active_status['value'];
	}


}
?>
