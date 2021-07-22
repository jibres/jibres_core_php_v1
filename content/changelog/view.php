<?php
namespace content\changelog;


class view
{
	public static function config()
	{
		$myTitle = T_('Change log of Jibres');
		if(\dash\request::get('tag'))
		{
			$myTitle .= ' | #'. \dash\request::get('tag');
		}
		\dash\face::title($myTitle);

		\dash\face::desc(T_('We were born to do Best!'). ' ' . T_("We are Developers, please wait!"));

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-changelog-1.jpg');

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		$list = \dash\app\changelog::public_list(\dash\request::get('tag'));
		\dash\data::dataTable($list);

		if(!$list && \dash\request::get())
		{
			\dash\redirect::to(\dash\url::this());
		}

	}
}
?>