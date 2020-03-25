<?php
namespace content_p\tag;

class view
{
	public static function config()
	{
		\dash\face::title(\lib\store::title(). ' | '. \dash\data::dataRow_title());
	}
}
?>