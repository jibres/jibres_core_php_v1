<?php
namespace content_business\profile\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("My profile"));

		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>
