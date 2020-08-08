<?php
namespace content_business\profile\avatar;


class view
{
	public static function config()
	{
		\dash\face::title(T_("My profile"));
		\dash\data::dataRow(\dash\user::detail());

		\dash\data::back_link(\dash\url::this());
	}
}
?>
