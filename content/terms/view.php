<?php
namespace content\terms;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Terms of Jibres Service Agreement'));
		\dash\face::desc(T_('Jibres acts upon international rules, depends on the countries receiving its services and renders its activities within this framework.'));

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-terms-1.jpg');

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>