<?php
namespace content_business;


class view
{
	public static function config()
	{
		\dash\data::store(\lib\store::detail());

		\dash\face::site(\lib\store::detail('title'));
		\dash\face::title(\lib\store::detail('title'));

		\dash\face::desc(\lib\store::detail('desc'));
		\dash\face::intro(\lib\store::detail('desc'));

		\dash\face::cover(\lib\store::logo());

	}
}
?>