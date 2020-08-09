<?php
namespace content_a\accounting\irvat\choosetype;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Choose factor type"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/all');

	}
}
?>