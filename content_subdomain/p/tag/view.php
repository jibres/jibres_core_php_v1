<?php
namespace content_subdomain\p\tag;

class view
{
	public static function config()
	{
		\dash\face::title(\lib\store::title(). ' | '. \dash\data::dataRow_title());
	}
}
?>