<?php
namespace content_subdomain\profile\avatar;


class view
{
	public static function config()
	{
		\dash\face::title(T_("My profile"));
		\dash\data::dataRow(\dash\user::detail());


	}
}
?>
