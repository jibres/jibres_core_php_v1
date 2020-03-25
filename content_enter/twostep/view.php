<?php
namespace content_enter\twostep;


class view
{
	public static function config()
	{
		if(!\dash\user::login())
		{
			\dash\header::status(403, T_("Please login to continue"));
		}

		\dash\face::title(T_('Two step verification'));

		\dash\face::desc(T_('You can trun it on or off'));



	}
}
?>