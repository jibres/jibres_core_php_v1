<?php
namespace content_developers\home;


class view
{
	public static function config()
	{
		\dash\face::site(T_('Jibres'));
		\dash\face::title(T_('Jibres API'));

		\dash\face::desc(T_('Power your bussiness with Jibres simple API.'));
		\dash\face::intro(T_('Detailed guides. Clear documentation. Powerful endpoints.'));
	}
}
?>