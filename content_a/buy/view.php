<?php
namespace content_a\buy;


class view
{
	public static function config()
	{
		\dash\permission::access('aFactorAdd');

		\dash\data::page_title(T_('Sale invoicing'));
		// \dash\data::page_desc(T_('Sale your product via Jibres and enjoy using integrated web base platform.'));
		\dash\data::badge_text(T_('Back to last sales'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
