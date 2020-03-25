<?php
namespace content_enter\google;


class view
{
	public static function config()
	{
		return false;
		$auth_url = \dash\utility\google::auth_url();

		// auto redirect if url is clean
		if($auth_url && !\dash\request::get() && !\dash\request::post() && \dash\data::googleLogin())
		{
			\dash\redirect::to($auth_url);
		}

		\dash\face::title(T_('Enter to :name with google', ['name' => \dash\face::site()]));

		\dash\face::desc(\dash\face::title());
	}
}
?>