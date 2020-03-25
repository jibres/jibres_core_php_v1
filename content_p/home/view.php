<?php
namespace content_p\home;

class view
{
	public static function config()
	{
		\dash\face::title(\lib\store::title(). ' | '. \dash\data::dataRow_title());
	}
}
?>