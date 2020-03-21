<?php
namespace content_a\app\android\intro;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Intro setting'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$saved_intro = \lib\app\application\intro::get();
		\dash\data::introSaved($saved_intro);

		\content_a\app\android\view::ready();
	}
}
?>
