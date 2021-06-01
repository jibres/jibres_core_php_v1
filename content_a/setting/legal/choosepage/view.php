<?php
namespace content_a\setting\legal\choosepage;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Legal Setting'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		$load = \lib\app\setting\policy_page::admin_load();

		\dash\data::policyPageDetail($load);


	}
}
?>