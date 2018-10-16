<?php
namespace content_a\product\units;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Units Setting'). ' | '. \dash\data::store_name());
		\dash\data::page_desc(T_('Check unit setting'));

	}
}
?>