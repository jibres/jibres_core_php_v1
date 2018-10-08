<?php
namespace content_a\setting\cats;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Cat Setting'). ' | '. \dash\data::store_name());
		\dash\data::page_desc(T_('Check unit setting'));

	}
}
?>