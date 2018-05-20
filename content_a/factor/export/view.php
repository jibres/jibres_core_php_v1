<?php
namespace content_a\factor\export;


class view
{
	public static function config()
	{
		\dash\permission::access('aFactorExport');

		\dash\data::page_title(T_('Export factors'));
		// \dash\data::page_desc('');

		\dash\data::badge_text(T_('Back to last sales'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
