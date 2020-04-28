<?php
namespace content_my\ipg\iban\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new IBAN'));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());


	}
}
?>