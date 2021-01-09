<?php
namespace content_business\tag;

class view
{
	public static function config()
	{
		\dash\face::title(\lib\store::title(). ' | '. T_("Tags"));
	}
}
?>