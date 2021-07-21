<?php
namespace content_a\accounting\factor\choosetype;


class view
{
	public static function config()
	{
		\dash\permission::access('_group_accounting');
		\dash\face::title(T_("Choose factor type"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

	}
}
?>