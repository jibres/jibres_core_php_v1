<?php
namespace content_my\ipg\wallet\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new Wallet'));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());


	}
}
?>