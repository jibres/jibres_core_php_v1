<?php
namespace content_love\store\transfer;


class view extends \content_love\store\setting\view
{
	public static function config()
	{
		\dash\face::title(T_("Transfer business fuel"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
