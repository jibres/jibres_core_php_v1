<?php
namespace content_a\accounting\turnover\detail;


class view extends \content_a\accounting\turnover\view
{
	public static function config()
	{
		\dash\face::title(T_('Turnover of Details'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		\dash\face::btnInsert('formreset');
		\dash\face::btnInsertText(T_("Reset"));

		self::load_list();
	}
}
?>
