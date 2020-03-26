<?php
namespace lib\app\website_header;

class get
{

	public static function active_header_detail()
	{
		$active_header = \lib\db\setting\get::platform_cat_key('website', 'header', 'active');
		if(!$active_header || !isset($active_header['value']))
		{
			return false;
		}

		$active_header_detail = \lib\app\website_header\template::get($active_header['value']);
		if(!$active_header_detail)
		{
			return false;
		}

		return $active_header_detail;

	}

}
?>
