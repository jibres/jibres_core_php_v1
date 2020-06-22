<?php
namespace content_subdomain\p\home;

class view
{
	public static function config()
	{
		\dash\face::title(\lib\store::title(). ' | '. \dash\data::dataRow_title());

		$property_list = \lib\app\product\property::get_pretty(\dash\data::dataRow_id());
		\dash\data::propertyList($property_list);
	}
}
?>