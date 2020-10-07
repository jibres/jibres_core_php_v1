<?php
namespace content_a\website\menu\sort;



class view
{
	public static function config()
	{
		\dash\face::title(T_('Sort menu items'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/edit?'. \dash\request::fix_get());

		$list = \dash\data::menuDetail_list();

		if(!$list || !is_array($list))
		{
			$list = [];
		}

		\dash\data::menuDetailList($list);

	}
}
?>
